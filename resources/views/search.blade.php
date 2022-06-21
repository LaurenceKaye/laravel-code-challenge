<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Code Challenge</title>
</head>
<body>
<div class="min-h-screen">
    <div class="rounded-xl bg-gray-200 m-3">
        <p class="text-lg font-semibold px-4 py-2">Search Term: <b>{{$searchTerm}}</b></p>
    </div>

    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Artists</p>

        <div class="flex flex-row flex-wrap">
            @foreach ($artists as $artist)
            <a href="{{ route('details', ['id' => $artist->id, 'type' => 'artists']) }}">
                <div class="py-4 px-4 min-w-sm max-w-sm mx-5 my-3 bg-white rounded-xl shadow-lg space-y-2 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
                    <img class="block mx-auto h-16 w-16 rounded-full sm:mx-0 sm:shrink-0" src="{{ $artist->images[0]->url ?? '/img/spotify.png' }}" alt="{{ $artist->name }}">
                    <div class="text-center space-y-2 sm:text-left">
                        <div class="space-y-0.5">
                            <p class="text-lg text-black font-semibold">
                                {{ $artist->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Albums</p>

        <div class="flex flex-row flex-wrap">
            @foreach ($albums as $album)
            <a href="{{ route('details', ['id' => $album->id, 'type' => 'albums']) }}">
                <div class="py-4 px-4 min-w-sm max-w-sm mx-5 my-3 bg-white rounded-xl shadow-lg space-y-2 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
                    <img class="block mx-auto h-16 w-16 rounded-full sm:mx-0 sm:shrink-0" src="{{ $album->images[0]->url ?? '/img/spotify.png' }}" alt="{{ $album->name }}">
                    <div class="text-center space-y-2 sm:text-left">
                        <div class="space-y-0.5">
                            <p class="text-lg text-black font-semibold">
                                {{ $album->name }}
                            </p>
                            <p class="text-slate-500 font-medium">
                                {{ $album->artists[0]->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Tracks</p>

        <div class="flex flex-row flex-wrap">
            @foreach ($tracks as $track)
            <a href="{{ route('details', ['id' => $track->id, 'type' => 'tracks']) }}">
                <div class="py-4 px-4 min-w-sm max-w-sm mx-5 my-3 bg-white rounded-xl shadow-lg space-y-2 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
                    <img class="block mx-auto h-16 w-16 rounded-full sm:mx-0 sm:shrink-0" src="{{ $track->album->images[0]->url ?? '/img/spotify.png' }}" alt="{{ $track->name }}">
                    <div class="text-center space-y-2 sm:text-left">
                        <div class="space-y-0.5">
                            <p class="text-lg text-black font-semibold">
                                {{ $track->name }}
                            </p>
                            <p class="text-slate-500 font-medium">
                                {{ $track->artists[0]->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
