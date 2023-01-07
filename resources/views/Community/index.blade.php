<x-app-layout>
    <div class='grid grid-cols-3 gap-4 just max-w-5xl mx-auto'>
        <div class=" col-span-2  ">
            <h1 class="text-3xl my-5 dark:text-gray-50 ">Contributions</h1>
            @if(!$links->isEmpty())
                <ul>
                </ul>
                @foreach($links as $link)
                    <li class="list-none my-5 ">
                    <span style="background-color: {{ $link->channel->color  }}"
                          class="text-white  text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $link->channel->title  }}</span>
                        <a class="hover:underline text-blue-400" href="{{ $link->link }}">
                            {{ $link->title  }}
                        </a>
                        <small class="dark:text-white ">Contributed by <span
                                class="text-blue-400 font-semibold">{{ $link->creator->name }} </span>{{ $link->created_at->diffForHumans() }}
                        </small>

                    </li>
                @endforeach
            @else
                <h1 class="dark:text-gray-200 " >Sorry, there's no contributions yet!</h1>
            @endif


        </div>
        @include('Community.add-contribute-link')
    </div>
</x-app-layout>
