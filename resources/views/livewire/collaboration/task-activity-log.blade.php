<div class="space-y-3 max-h-[500px] overflow-y-auto ">
    @forelse ($logs as $log)
        <div class="bg-white dark:bg-dark border border-gray-200 dark:border-gray-700 p-3 rounded-xl shadow-sm">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>{{ $log->user->name }}</strong> 
                </p>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $log->created_at->diffForHumans() }}
                </span>
            </div>
            @if ($log->note)
                <p class="text-xs italic text-gray-500 dark:text-gray-400 mt-1">
                    “{{ $log->note }}”
                </p>
            @endif
        </div>
    @empty
        <p class="text-sm text-gray-400 italic text-center">Belum ada aktivitas tercatat </p>
    @endforelse
</div>
