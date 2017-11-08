@if(count($errors)>0)
    <div class="alert alert-danger">
        <h4>有错误发生：</h4>
        <ul>
            @foreach($errors->all() as $e)
                <li><i class="glyphicon glyphicon-remove"></i>
                    {{$e}}
                </li>
            @endforeach
        </ul>
    </div>
@endif