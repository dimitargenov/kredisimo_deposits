@if(!empty($accounts))
  @foreach($accounts as $account)
    <option value="{{ $account['id'] }}">{{ $account['name'] }}</option>
  @endforeach
@endif