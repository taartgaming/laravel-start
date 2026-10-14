<x-layout title="create">
    <form method="post" action="{{route('moveset.store')}} " enctype="multipart/form-data">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{old('name')}}">
            @error('name')
            <span> {{$message}}</span>
            @enderror
        </div>
        <div>
            <label for="num_moves">number of moves</label>
            <input type="number" name="num_moves" id="num_moves" value="{{old('num_moves')}}">
            @error('num_moves')
            <span> {{$message}}</span>
            @enderror
        </div>
        <div>
            <label for="algorithm">Algorithm</label>
            <input type="text" name="algorithm" id="algorithm" value="{{old('algorithm')}}">
            @error('algorithm')
            <span> {{$message}}</span>
            @enderror
        </div>
        <div>
            <label for="description">description</label>
            <input type="text" name="description" id="description" value="{{old('description')}}">
            @error('description')
            <span> {{$message}}</span>
            @enderror
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            @error('image')
            <span> {{$message}}</span>
            @enderror
        </div>
        <div>
            <button type="submit"
                    class=" cursor-pointer bg-[#B71234] rounded p-2 shadow-bg-[#B71234]/50 hover:bg-[#FFD500]">Submit
            </button>
        </div>
    </form>
</x-layout>
