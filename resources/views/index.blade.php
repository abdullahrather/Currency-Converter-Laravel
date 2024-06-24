@extends('layouts.main')
@section('main-section')
  <main class="container">
    <section class="boxes">
      <div class="box box-left">
        <h4 class="app-title">Laravel - Currency &nbsp;converter</h4>
        <div class="app-info">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum illo, labore harum corrupti enim maiores ipsa animi veniam eius? Ullam pariatur ipsum voluptates eaque debitis illum maxime provident nulla perspiciatis.</p>
        </div>
      </div>
      <div class="box box-right">
        <form action="/convert" method="POST">
          @csrf
          <div class="currency-btn-group">
            <div class="input-group">
              <label for="amount" class="label small-text">enter amount</label>
              <input type="text" class="text-field" name="amount" placeholder="1.00">
            </div>
            <div class="input-group">
              <label for="from" class="label small-text">from</label>
              <select name="from" class="currency-names">
                <option>EUR</option>
              </select>
            </div>
            <div class="input-group">
              <label for="to" class="label small-text">to</label>
              <select name="to" class="currency-names">
                <option>USD</option>
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
