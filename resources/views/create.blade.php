@extends('layouts.app')

@section('title', 'Create a New Task')

@section('content')
    <h1>Create a New Task</h1>
    <form method="post" action="{{ route('task.store') }}">
        @csrf
        <div style="margin-bottom: 1.5rem;">
            <label for="title"
                style="display: block; text-transform: uppercase; color: #374151; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.5rem;">Title</label>
            <input type="text" name="title" id="title"
                style="display: block; width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #1f2937; box-sizing: border-box; font-size: 1rem;">
            @error('title')
                <div style="color: red; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="description"
                style="display: block; text-transform: uppercase; color: #374151; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.5rem;">Description</label>
            <textarea name="description" id="description" rows="4"
                style="display: block; width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #1f2937; box-sizing: border-box; font-size: 1rem; font-family: inherit;"></textarea>
            @error('description')
                <div style="color: red; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="long_description"
                style="display: block; text-transform: uppercase; color: #374151; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.5rem;">Long
                Description</label>
            <textarea name="long_description" id="long_description" rows="10"
                style="display: block; width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #1f2937; box-sizing: border-box; font-size: 1rem; font-family: inherit;"></textarea>
            @error('long_description')
                <div style="color: red; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit"
            style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.375rem; border: none; font-weight: 600; cursor: pointer; font-size: 1rem; transition: background-color 0.2s;">Create
            Task</button>
    </form>
@endsection
