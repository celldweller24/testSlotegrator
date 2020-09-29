@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <p>
                            You won $ {{ $wonPrizeValue }}
                        </p>
                    </div>

                    <div class="main-button">
                        <form action="{{ route('money') }}" method="POST">
                            @csrf
                            <input type="submit" value="send_to_bank" name="send_to_bank">
                            <input type="submit" value="convert_to_bonus" name="convert_to_bonus">
                            <input type="hidden" name="prize_type" value="{{ $prizeType }}">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection