<div class="">
    <h1 class="text-3xl my-5  dark:text-gray-50">Contribute Resource</h1>
    @auth()
        <div>
            <form method="POST" class="bg-gray-200 p-5 rounded dark:bg-gray-700" action="{{ route('Community.store')  }}">
                @csrf
                <div class="mb-6">
                    <select name="channel_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pick a channel</option>
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id  }}"  {{ old('channel_id') == $channel->id ? 'selected' : ''  }}   >{{ $channel->title  }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('channel_id', '<span class="text-red-400 dark:text-red-300">:message</span>')  !!}
                </div>
                <div class="mb-6">
                    <input type="text" name="title" value="{{ old('title')  }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Title about your blog">
                    {!! $errors->first('title', '<span class="text-red-400 dark:text-red-300">:message</span>')  !!}
                </div>
                <div class="mb-6">
                    <input type="text" name="link" value="{{ old('link')  }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="The link of the blog">
                    {!! $errors->first('link', '<span class="text-red-400 dark:text-red-300">:message</span>')  !!}

                </div>
                <div class="text-end">
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Contribute Link
                    </button>
                </div>
            </form>

        </div>
    @endauth
    @guest()
        <h4>Please sign in!</h4>
        @endguest()
</div>
