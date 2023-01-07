<x-app-layout>
    <div class='grid grid-cols-3 gap-4 just max-w-5xl mx-auto'>
        <div class=" col-span-2  ">
            <h1 class="text-3xl my-5">Contributions</h1>
            <ul>
            </ul>
            @foreach($links as $link)
                <li class="list-none my-5 ">
                    <a class="hover:underline text-blue-400" href="{{ $link->link }}">
                        {{ $link->title  }}
                    </a>
                    <small class="dark:text-white ">Contributed by <span
                            class="text-blue-400 font-semibold">{{ $link->creator->name }} </span>{{ $link->created_at->diffForHumans() }}
                    </small>

                </li>
            @endforeach
        </div>
        @include('Community.add-contribute-link')
    </div>
</x-app-layout>
