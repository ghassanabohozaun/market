<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card card-settings-premium">
            <div class="card-body">
                <h4 class="card-title">{{ __('dashboard.my_tasks') }}</h4>
                <div class="list-wrapper">
                    <ul class="todo-list">
                        @foreach ($tasks as $task)
                            <li class="{{ $task->is_completed ? 'completed' : '' }}" wire:key="task-{{ $task->id }}">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"
                                            wire:click="toggleTask({{ $task->id }})"
                                            {{ $task->is_completed ? 'checked' : '' }}>
                                        {{ $task->title }}
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"
                                    wire:click="deleteTask({{ $task->id }})"></i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0">
                <form wire:submit.prevent="addTask">
                    <div class="input-group-premium d-flex mb-0">
                        <span class="input-group-text"><i class="mdi mdi-playlist-plus text-primary"></i></span>
                        <input type="text" class="form-control"
                            placeholder="{{ __('dashboard.what_do_you_need_to_do_today') }}" wire:model="newTaskTitle">
                        <button class="btn btn-primary font-weight-bold text-white  px-4" id="add-task" type="submit"
                            wire:loading.attr="disabled">
                            <i class="ti-location-arrow  me-1"></i>
                        </button>
                    </div>
                    @error('newTaskTitle')
                        <strong class="text-danger small mt-1 d-block">{{ $message }}</strong>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>
