<div class=" col-span-2  ">

    <h3 class="text-black dark:text-gray-50 flex items-center gap-4 ">
        <a href="{{ route('Community.index')  }}"  class="text-3xl my-5 text-blue-600  dark:text-blue-600 ">Contributions</a>
        @if($channel)
            <span  class="dark:text-gray-50 ">- {{$channel->title}}</span>
        @endif
    </h3>
    @if(!$links->isEmpty())
        <ul>
        </ul>
        @foreach($links as $link)
            <li class="list-none my-5 border p-2 border-4 rounded flex ">
                    <a href="{{ route('Community.channel', $link->channel->slug)  }}" style="background-color: {{ $link->channel->color  }}"
                          class="text-white  text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $link->channel->title  }}</a>
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
        <h1 class="dark:text-gray-200 " >Sorry, there's no contributions yet!</h1>
    @endif


</div>
