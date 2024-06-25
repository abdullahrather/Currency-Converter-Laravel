@extends('layouts.main')
@section('main-section')
  <main class="container">
    <section class="boxes">
    <div class="box box-left">
      <h4 class="app-title">Laravel - Currency &nbsp;converter</h4>
      <div class="app-info">
        @if (session('conversion'))
        <div class="medium-text">{{ session('conversion') }}</div>
        @elseif ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="medium-text text-danger" style="color: red;">{{ $error }}</div>
        @endforeach
        @endif
      </div>
      </div>
      <div class="box box-right">
        <form action="{{ url('/convert') }}" method="POST">
          @csrf
          <div class="currency-btn-group">
            <div class="input-group">
              <label for="amount" class="label small-text">enter amount</label>
              <input type="text" class="text-field" value="{{ old('amount', '1.00') }}" name="amount"
                placeholder="1.00">
            </div>
            <div class="input-group">
              <label for="from" class="label small-text">from</label>
              <select name="from" class="currency-names">
                @foreach ($rates as $currency => $rate)
                  <option value="{{ $currency }}" {{ old('from', 'EUR') == $currency ? 'selected' : '' }}>
                    {{ $currency }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="input-group">
              <label for="to" class="label small-text">to</label>
              <select name="to" class="currency-names">
                @foreach ($rates as $currency => $rate)
                  <option value="{{ $currency }}" {{ old('to', 'USD') == $currency ? 'selected' : '' }}>
                    {{ $currency }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="input-group">
              <button type="submit" class="currency-btn small-text">convert currency</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
@endsection
