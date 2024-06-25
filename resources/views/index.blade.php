@extends('layouts.main')
@section('main-section')
  <main class="container">
    <section class="boxes">
      <div class="box box-left">
        <h4 class="app-title">Laravel - Currency &nbsp;converter</h4>
        <div class="app-info">
          @if (session('conversion'))
            <!-- Display conversion message if available -->
            <div class="medium-text">{{ session('conversion') }}</div>
          @elseif ($errors->any())
            <!-- Display validation errors if any -->
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
              <select id="from" name="from" class="currency-names">
                <!-- Loop through rates to display currency options -->
                @foreach ($rates as $currency => $rate)
                  <option value="{{ $currency }}" {{ old('from', 'EUR') == $currency ? 'selected' : '' }}>
                    {{ $currency }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="input-group switch-container">
              <button type="button" class="currency-switch-btn" onclick="switchCurrencies()">
                <i class="fas fa-exchange-alt"></i>
              </button>
            </div>
            <div class="input-group">
              <label for="to" class="label small-text">to</label>
              <select id="to" name="to" class="currency-names">
                <!-- Loop through rates to display currency options -->
                @foreach ($rates as $currency => $rate)
                  <option value="{{ $currency }}" {{ old('to', 'USD') == $currency ? 'selected' : '' }}>
                    {{ $currency }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="input-group convert-btn-container">
              <button type="submit" class="currency-btn small-text">convert currency</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
@endsection

<!-- JavaScript function to switch currencies -->
<script>
  function switchCurrencies() {
    var fromSelect = document.getElementById('from');
    var toSelect = document.getElementById('to');

    var fromValue = fromSelect.value;
    fromSelect.value = toSelect.value;
    toSelect.value = fromValue;
  }
</script>
