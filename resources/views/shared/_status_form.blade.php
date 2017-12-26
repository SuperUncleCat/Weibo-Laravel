<form action="{{ route('statuses.store') }}" method="POST">
  @include('shared._errors')
  {{ csrf_field() }}
  <textarea class="form-control" rows="3" placeholder="Say something..." name="content">{{ old('content') }}</textarea>
  </br>
  <button type="submit" class="btn btn-primary pull-right">Send</button>
</form>
