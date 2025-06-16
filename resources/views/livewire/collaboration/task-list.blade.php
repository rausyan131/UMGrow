<div class="flex flex-col-reverse lg:flex-row gap-6 xl:max-h-[77vh]">

    <div class="w-full lg:w-2/3 flex flex-col space-y-4">

        {{-- Filter --}}
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <select wire:model="filterBy"
                class="w-full sm:w-auto px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none shadow-md transition duration-200">
                <option value="all">Semua Tugas</option>
                <option value="initiator">Hanya Inisiator</option>
                <option value="partner">Hanya Partner</option>
                <option value="both">Hanya Keduanya</option>
            </select>

            <button wire:click="applyFilter"
                class="w-full sm:w-auto flex items-center gap-2 bg-gray-800 text-white px-5 py-2 rounded-xl text-sm hover:bg-gray-700 transition shadow-lg">
                <i class="fas fa-filter"></i> Sortir
            </button>
        </div>

        {{-- Progress --}}
        @if (count($tasks) > 0)
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress Tugas</h2>
                    <span class="text-sm font-semibold text-primary">{{ $this->progressPercentage }}%</span>
                </div>
                <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden shadow-md">
                    <div class="h-full bg-primary rounded-full transition-all duration-500"
                        style="width: {{ $this->progressPercentage }}%"></div>
                </div>
            </div>
        @endif


        {{-- Task List --}}
        <ul class="mt-10 space-y-3 xl:overflow-y-auto pr-2 xl:max-h-[80vh]">
            @forelse ($tasks as $task)
                <li wire:key="task-{{ $task->id }}"
                    class=" bg-white dark:bg-dark border-t border-b border-gray-200 dark:border-gray-700 p-4 py-5  transition ">

                    <div class="flex justify-between items-center gap-3">
                        <div class="flex items-start gap-3">

                            <label class="relative w-5 h-5 inline-block cursor-pointer">
                                <input type="checkbox" wire:click="toggleDone({{ $task->id }})"
                                    @checked($task->is_done)
                                    class="peer appearance-none w-5 h-5 border border-orange-400 dark:border-orange-300 rounded bg-white dark:bg-gray-700 checked:bg-orange-500 checked:border-orange-500 focus:ring-2 focus:ring-orange-300 transition duration-200">
                                <i
                                    class="fas fa-check absolute top-1 left-1 text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200 pointer-events-none"></i>
                            </label>

                            <div class="space-y-1">
                                <p class="text-sm text-gray-800 dark:text-white">
                                    {{ $task->task }}
                                </p>
                                <p class="text-xs  text-gray-500 dark:text-gray-400">
                                    Ditugaskan ke:
                                    @if ($task->assigned_to === 'initiator')
                                        <span class="text-blue-600 font-medium">Inisiator</span>
                                    @elseif ($task->assigned_to === 'partner')
                                        <span class="text-green-600 font-medium">Partner</span>
                                    @elseif ($task->assigned_to === 'both')
                                        <span class="text-purple-600 font-medium">Inisiator & Partner</span>
                                    @endif
                                </p>
                                @if ($task->deadline)
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Deadline:
                                        {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</p>
                                @endif

                                @if ($task->creator)
                                    <p class="text-xs text-gray-400">Ditambah oleh:
                                        <strong>{{ $task->creator->name }}</strong>
                                    </p>
                                @endif

                                @if ($task->is_done && $task->completer)
                                    <p class="text-xs text-green-500">Diselesaikan oleh:
                                        <strong>{{ $task->completer->name }}</strong> <span
                                            class="text-gray-400">({{ \Carbon\Carbon::parse($task->completed_at)->diffForHumans() }})</span>
                                    </p>
                                @endif

                                {{-- Form Edit  --}}
                                @if ($editTaskId === $task->id)
                                    <div
                                        class="w-full mt-8 p-4 space-y-4 border-t border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-wrap gap-4">

                                            <div class="flex-1 min-w-[250px]">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                    Edit Nama Tugas
                                                </label>
                                                <input type="text" wire:model.defer="editedTask"
                                                    class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none"
                                                    placeholder="Edit tugas...">
                                            </div>

                                            <div class="flex-1 min-w-[250px]">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                    Edit Deadline
                                                </label>
                                                <input type="date" wire:model="editedDeadline"
                                                    class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none">
                                            </div>

                                            <div class="flex-1 min-w-[250px]">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                    Edit Penanggung Jawab
                                                </label>
                                                <select wire:model="editedAssignedTo"
                                                    class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none">
                                                    <option value="initiator">Inisiator</option>
                                                    <option value="partner">Partner</option>
                                                    <option value="both">Keduanya</option>
                                                </select>
                                            </div>

                                            <div class="flex-1 min-w-[250px]">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                    Catatan Edit (opsional)
                                                </label>
                                                <input type="text" wire:model.defer="editNote"
                                                    class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none">
                                            </div>
                                        </div>

                                        {{-- Tombol Aksi --}}
                                        <div class="flex justify-end gap-3 pt-4">
                                            <button wire:click="cancelEdit"
                                                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-xl text-sm hover:bg-gray-400 transition-all ease-in-out">
                                                Batal
                                            </button>
                                            <button wire:click="updateTask({{ $task->id }})"
                                                class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl text-sm transition-all ease-in-out">
                                                <i class="fas fa-check mr-1"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>

                        @if ($editTaskId != $task->id)
                            <div class="flex gap-2">
                                <button wire:click="editTask({{ $task->id }})"
                                    class="text-md bg-amber-400 hover:bg-amber-500 px-5 py-1 rounded-tr-lg rounded-bl-lg text-white transition-all ease-in-out">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="deleteTask({{ $task->id }})"
                                    class="text-md bg-red-500 hover:bg-red-600 px-5 py-1 rounded-tr-lg rounded-bl-lg text-white transition-all ease-in-out">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </li>
            @empty
                <li class="text-center py-10 space-y-2 text-gray-400">
                    <div class="text-4xl text-primary/50">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <p class="">Belum ada tugas</p>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="w-full lg:w-1/3 flex flex-col space-y-4  xl:overflow-hidden">
        {{-- form tambah --}}
        <form wire:submit.prevent="addTask" class="glass rounded-lg p-4 shadow-lg border grid grid-cols-1 gap-3">
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Tugas</label>
                <input type="text" wire:model="newTask" placeholder="Tugas baru..."
                    class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-dark bg-white text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none shadow" />
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Deadline</label>
                <input type="date" wire:model="newDeadline"
                    class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-dark bg-white text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none shadow" />
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Penanggung Jawab</label>
                <select wire:model="assignedTo"
                    class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-dark bg-white text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:outline-none shadow">
                    <option value="initiator">Inisiator</option>
                    <option value="partner">Partner</option>
                    <option value="both">Keduanya</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center gap-2 bg-primary text-white px-5 py-2 rounded-xl text-sm hover:bg-primary/80 transition shadow-lg">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </form>

        {{-- Log --}}
        <div class="flex-1 glass p-4 shadow-lg border space-y-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Log Aktivitas</h3>
            <livewire:collaboration.task-activity-log :collaboration-id="$collaborationId" />
        </div>
    </div>
</div>
