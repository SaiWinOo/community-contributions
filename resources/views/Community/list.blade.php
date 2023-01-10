<div class=" col-span-2  ">
    <h3 class="text-black dark:text-gray-50 flex items-center gap-4 ">
        <a href="{{ route('Community.index')  }}"
           class="text-3xl my-5 text-blue-600  dark:text-blue-600 ">Contributions</a>
        @if($channel)
            <span class="dark:text-gray-50 ">- {{$channel->title}}</span>
        @endif
    </h3>
    <div class="bg-gray-600 text-red-400 p-2 font-bold ">
        <span   class="mr-3 {{ request('popular') ?'' : 'text-green-500 shadow'  }}" ><a href="{{ request()->url()  }}">Most Recent</a></span>
        <span class="{{ request('popular') == true ? 'text-green-500 shadow' : ''  }}"  ><a href="?popular=true">Most Popular</a></span>
    </div>
    @if(!$links->isEmpty())
        <ul>
        </ul>
        @foreach($links as $link)
            <li class="list-none my-5 border p-2 border-4 rounded flex ">
                <form action="{{ route('votes.store', $link) }}" method="POST">
                    @csrf
                    <button {{ auth()->guest() ? 'disabled' : ''  }}  class="p-2 inline-block  border dark:text-white  mr-3 border-gray-400 {{ auth()->check() &&  auth()->user()->votedFor($link) ? 'bg-green-400 text-white ' : '' }}">{{ $link->votes->count()  }}</button>
                </form>
                <a href="{{ route('Community.channel', $link->channel->slug)  }}"
                   style="background-color: {{ $link->channel->color  }}"
                   class="text-black  text-xs dark:text-black  font-medium mr-2 px-2.5 py-0.5 rounded">{{ $link->channel->title  }}</a>
                <div class="flex flex-col ">
                    <a class="hover:underline text-xl   text-blue-400" href="{{ $link->link }}">
                        {{ $link->title  }}
                    </a>
                    <small class="dark:text-white ">Contributed by <span
                            class="text-red-500  font-semibold">{{ $link->creator->name }} </span>{{ $link->updated_at->diffForHumans() }}
                    </small>
                </div>

            </li>
        @endforeach
        <div class="my-5">
            {{ $links->links()  }}
        </div>
    @else
        <h1 class="dark:text-gray-200 ">Sorry, there's no contributions yet!</h1>
    @endif


</div>
