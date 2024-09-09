@extends('layouts.app')

@section('main')
    <main id="content" role="main" class="container-fluid mt-5 mb-5">
        <div class="card text-center chatCard">
            <div class="card-header bg-light text-left">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiPjxkZWZzPjxjaXJjbGUgaWQ9ImEiIGN4PSIyMCIgY3k9IjIwIiByPSIyMCIvPjxwYXRoIGlkPSJjIiBkPSJNMCAwaDMxLjY2N3YyMy4zMzNIMHoiLz48L2RlZnM+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48bWFzayBpZD0iYiIgZmlsbD0iI2ZmZiI+PHVzZSB4bGluazpocmVmPSIjYSIvPjwvbWFzaz48dXNlIGZpbGw9IiNGRkUxMUIiIGZpbGwtcnVsZT0ibm9uemVybyIgeGxpbms6aHJlZj0iI2EiLz48ZyBtYXNrPSJ1cmwoI2IpIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1IDE2LjY2NykiPjxtYXNrIGlkPSJkIiBmaWxsPSIjZmZmIj48dXNlIHhsaW5rOmhyZWY9IiNjIi8+PC9tYXNrPjxwYXRoIGZpbGw9IiMwMjdDRDUiIGQ9Ik0yMS4zOTMgMTcuMTM1aDIuODc4YzEuMDcgMCAxLjc2LS43OTYgMi4wNzgtMi41ODQuMjk5LTEuNzE1LS4wOS0yLjQ4LTEuMTYzLTIuNDhoLTIuODgybC40NTUtMi41NzNjLjUwOC0yLjkzOCAyLjAxOC00LjM4OCA0LjUtNC4zODhoLjQ3M2MxLjM4IDAgMi4xMzQtLjIyOCAyLjI0LS44ODQuMDg1LS40NC0uMDM5LTEuMDQ3LS4xNzctMS43MTUtLjE0Ni0uNjUtLjMwMS0xLjI3OC0uNTIyLTEuNjNDMjguOTM5LjI4NiAyOC4xNzMgMCAyNi45NyAwYy0yLjk4IDAtNS40MzQuODM3LTcuMzY3IDIuNTMtMS45MjQgMS42ODItMy4xNTEgMy45NDQtMy42OTIgNy4wMTNsLS40NjIgMi41MjlIOS40MDJjLS4wOTcgMC02LjM0Ny43MDgtNi4zNDcuNzA4bDUuNzUzLjg4Ni4yMzIuODU0LTMuNTIxLjMgMy43MDEuNTQyLjE0Ni42OTUtMTEuMDMzLjYyczExLjkxLjQ1OCAxMi4wMDUuNDU4aDQuMTkybC0xLjA4MyA2LjE5OGg2Ljg3bDEuMDc2LTYuMTk4eiIgbWFzaz0idXJsKCNkKSIvPjwvZz48L2c+PC9nPjwvc3ZnPg==" />
                <span class="clearfix">
                    <span class="badge text-white float-left fs-1 a_chat bg-green mb-1 mt-1">CustomerCare</span>
                    <span class="badge text-white float-right fs-1 a_chat bg-danger mb-1 mt-1">{{ session('firstname') }}</span>
                </span>
            </div>
            <div class="card-body" style="min-height:350px;">
                
                        @foreach ($chatDatas as $chatData)
                @if($chatData['sender'] == 'customercare')
                    <div class="clearfix mb-3">
                        <!-- Customer Care Message -->
                        <span class="badge text-white float-left fs-1 a_chat bg-info p-2">
                            {{$chatData['msg']}}
                        </span>
                        <!-- Time below the message -->
                        <div class="float-left w-100 text-left">
                            <small class="text- d-block mt-1">{{$chatData['time']}}</small>
                        </div>
                    </div>
                @else
                    <div class="clearfix mb-3">
                        <!-- User Message -->
                        <span class="badge text-white float-right a_chat bg-warning p-2">
                            {{$chatData['msg']}}
                        </span>
                        <!-- Time below the message -->
                        <div class="float-right w-100 text-right">
                            <small class="text-dark d-block mt-1">{{$chatData['time']}}</small>
                        </div>
                    </div>
                @endif
            @endforeach

                
            </div>
            <div class="card-footer text-body-secondary bg-white">
                <form id="chatForm">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="chatInput form-control-lg w-100 rounded-0 border border-0" id="exampleFormControlInput1" placeholder="Write a Message...">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-lg">Send
                                    <i class="fa-solid fa-message"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection