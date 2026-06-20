<?php

namespace App\Traits\Dashboard;

use App\Models\ProductVariant;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Exception;

trait HasInventory
{
    /**
     * Check if the product has enough stock.
     */
    public function hasEnoughStock($quantity, $variantId = null): bool
    {
        if (!$this->manage_stock) {
            return true; // Infinite stock if not managed
        }

        if ($this->has_variants && $variantId) {
            $variant = $this->productVariants()->find($variantId);
            return $variant && $variant->stock >= $quantity;
        }

        return $this->quantity >= $quantity;
    }

    /**
     * Decrement the stock of the product.
     * Uses pessimistic locking to prevent race conditions.
     */
    public function decrementStock($quantity, $variantId = null): bool
    {
        if (!$this->manage_stock) {
            return true;
        }

        return DB::transaction(function () use ($quantity, $variantId) {
            if ($this->has_variants && $variantId) {
                // Lock the variant row for update
                $variant = ProductVariant::where('id', $variantId)->lockForUpdate()->first();
                if (!$variant || $variant->stock < $quantity) {
                    throw new Exception(__('products.out_of_stock'));
                }

                $variant->stock -= $quantity;
                $variant->save();
                return true;
            }

            // Lock the product row for update
            // We use lockForUpdate on a fresh instance to ensure the lock is acquired
            $lockedProduct = self::where('id', $this->id)->lockForUpdate()->first();
            if (!$lockedProduct || $lockedProduct->quantity < $quantity) {
                throw new Exception(__('products.out_of_stock'));
            }

            $lockedProduct->quantity -= $quantity;
            $lockedProduct->save();

            // Update the current instance
            $this->quantity = $lockedProduct->quantity;

            return true;
        });
    }

    /**
     * Increment the stock of the product (e.g., when an order is cancelled or item removed).
     */
    public function incrementStock($quantity, $variantId = null): bool
    {
        if (!$this->manage_stock) {
            return true;
        }

        return DB::transaction(function () use ($quantity, $variantId) {
            if ($this->has_variants && $variantId) {
                $variant = ProductVariant::where('id', $variantId)->lockForUpdate()->first();
                if ($variant) {
                    $variant->stock += $quantity;
                    $variant->save();
                }
                return true;
            }

            $lockedProduct = self::where('id', $this->id)->lockForUpdate()->first();
            if ($lockedProduct) {
                $lockedProduct->quantity += $quantity;
                $lockedProduct->save();

                $this->quantity = $lockedProduct->quantity;
            }

            return true;
        });
    }

    /**
     * Get the remaining quantity.
     */
    public function getRemainingQuantityAttribute()
    {
        if (!$this->manage_stock) {
            return '∞';
        }

        if ($this->has_variants) {
            return $this->productVariants()->sum('stock');
        }

        return $this->quantity;
    }

    /**
     * Get the total consumed (sold) quantity.
     */
    public function getConsumedQuantityAttribute()
    {
        return OrderItem::where('product_id', $this->id)->sum('product_quantity');
    }

    /**
     * Check if the entire product is out of stock
     */
    public function getIsOutOfStockAttribute()
    {
        if (!$this->manage_stock) {
            return false;
        }

        return $this->remaining_quantity <= 0;
    }
}
