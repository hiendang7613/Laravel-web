<h2>Demo test Unicode</h2>
@if (session('mess'))
    <div class="alert alert-success">{{session('mess')}}</div>
@endif
<form action="" method="POST">
    <input type="text" name="username" value="{{old('username')}}" placeholder="Username...">
    <button type="submit" class="btn btn-primary">Submit</button>
    @csrf
</form>