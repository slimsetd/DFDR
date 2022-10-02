@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.classic.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.classic.title') }}
@endsection

@section('container')

    <form method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}
        <textarea class="textarea" name="envConfig">{{ $envConfig }}</textarea>

        <!-- Custom Alert -->
        <div class="alert" id="error_alert" style="background: #d44b4b; color: white; display: none;">
            <label id="txt_alert"></label>
            <button type="button" id="cls_alert" 
                    style="background-color: transparent; width: 25px;
                            height: 25px; padding: 0;margin: 0;border: none;
                            position: absolute; right: 3px; top: 7px;">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
        <!-- END -->

        <div class="buttons buttons--right">
            <button class="button button--light" type="submit">
            	<i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>
             	{!! trans('installer_messages.environment.classic.save') !!}
            </button>
        </div>
    </form>

    @if( ! isset($environment['errors']))
        <div class="buttons-container">
            <a class="button float-left" href="{{ route('LaravelInstaller::environmentWizard') }}">
                <i class="fa fa-sliders fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.back') !!}
            </a>

            <button class="button float-right" id="btn-test" style="font-size: 15px;">
                Check Connection
                &nbsp;<i class="fa fa-wifi fa-fw" style="font-size:14px;"></i>
            </button>
            
            <a class="button float-right" id="btn-next" style="display: none;" href="{{ route('LaravelInstaller::database') }}">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.install') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection

@section('scripts')
    <script>
        $(document).ready(function()
        {
            $("textarea").change(function() {
                $('#btn-test').show();
                $('#btn-next').hide();
            });

            $('#btn-test').click(function(){
                event.preventDefault();
                var str = $('textarea').val().trim();
                var arr = str.split(/\r?\n/);

                var db_property = [];

                arr.forEach(function(val){
                    var split = val.split("=");
                    switch (split[0]) 
                    {
                        case 'DB_CONNECTION':
                            db_property[0] = split[1];
                            break;

                        case 'DB_HOST':
                            db_property[1] = split[1];
                            break;

                        case 'DB_PORT':
                            db_property[2] = split[1];
                            break;

                        case 'DB_DATABASE':
                            db_property[3] = split[1];
                            break;

                        case 'DB_USERNAME':
                            db_property[4] = split[1];
                            break;

                        case 'DB_PASSWORD':
                            db_property[5] = split[1];
                            break;
                    }
                });

                // console.log(db_property);
                $.ajax({
                    type: "GET",
                    enctype: "multipart/form-data",
                    url: "{{ route('LaravelInstaller::environmentCheckConnection') }}",
                    data: {
                            'database_connection': db_property[0],
                            'database_hostname' : db_property[1],
                            'database_port' : db_property[2],
                            'database_name' : db_property[3],
                            'database_username' : db_property[4],
                            'database_password' : db_property[5]
                    },
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success: function(data){
                        // console.log(data);
                        if (data.success == true)
                        {
                            $('#error_alert').show();
                            $('#error_alert').css('background-color', '#25bd11');
                            $('#txt_alert').html('Connection Success !');
                            $('#btn-next').show();
                            $('#btn-test').hide();
                        }
                        else
                        {
                            $('#error_alert').show();
                            $('#error_alert').css('background-color', '#d44b4b');
                            $('#txt_alert').html('Connection Error ! &nbsp;Please check your input again');
                        }
                    }, 
                    error: function(x){
                        console.log('error');
                    }
                }); 
            });

            $("#cls_alert").click(function(){
                $('#error_alert').hide();
            });         
        });
    </script>
@endsection