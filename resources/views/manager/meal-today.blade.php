@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Today All Meals</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Today Meals</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meals as $meal)
                                    <tr>
                                        <td>{{ $meal->date }}</td>
                                        <td>{{ $meal->user->name }}</td>
                                        <td class="text-capitalize">{{ $meal->user->role }}</td>
                                        <td>{{ $meal->breakfast + $meal->lunch + $meal->dinner }}</td>
                                        <td>
                                            <form action="{{ route('manager.meal.delete', $meal->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure to delete this meal?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
