@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="jumbotron text-center">
                <h1 class="display-4 m-0">Query Builder</h1>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif

                <form action="{{route('query.builder')}}" method="post">
                  @csrf
                    <table class="table table-bordered table-hover" id="dynamic_field">
                    </table>
                    {{-- <table class="table table-bordered table-hover" id="dynamic_field">
                        <tr>
                            <td>
                                <select class="form-control" name="name7[]">
                                    <option>Email</option>
                                    <option>First Name</option>
                                    <option>Last Name</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="name8[]">
                                    <option>is</option>
                                    <option>is_not</option>
                                    <option>starts_with</option>
                                    <option>ends_with</option>
                                    <option>contains</option>
                                    <option>doesnot_starts_with</option>
                                    <option>doesnot_ends_with</option>
                                    <option>doesnot_contains</option>
                                </select>
                            </td>
                            <td><input type="date" name="name9[]" class="form-control name_list" /></td>
                            <td>
                                <select class="form-control" name="name10[]">
                                    <option>Or</option>
                                    <option>And</option>
                                </select>
                            </td>
                        </tr>
                    </table> --}}{{-- 
                    <table class="table table-bordered table-hover" id="dynamic_field">
                       
                    </table> --}}

                    
                    <button type="button" name="add" id="add" class="btn btn-primary">Rule1 +</button>
                    <button type="button" name="rule2" id="rule2" class="btn btn-primary">Rule2 +</button>
                    <button type="button" name="rule3" id="rule3" class="btn btn-primary">Rule3 +</button>
                <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
      var i = 1;
      var k = 1;
      var m = 1;

      $("#add").click(function(){
        i++;
        k++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><select class="form-control" name="name1[]"><option>created_at</option><option>birthday</option></select></td><td><select class="form-control" name="name2[] id="field_show"><option value="Between">Between</option></select></td><td><input type="date" name="name3[]" class="form-control name_list" /></td><td><input id="field_hide" type="date" name="name4[]" class="form-control name_list"/></td><td id="con'+k+'"></td><td><button type="button" name="condition" id="'+k+'" class="btn btn-success btn_condition">+</button></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td><td><input type="hidden" name="rule[]" value="1" /></td> </tr>');  
      });

      $("#rule2").click(function(){
        i++;
        k++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><select class="form-control" name="name1[]"><option>created_at</option><option>birthday</option></select></td><td><select class="form-control" name="name2[] id="field_show"><option value="After">After</option><option value="Before">Before</option><option value="On">On</option></select></td><td><input type="date" name="name3[]" class="form-control name_list" /></td><td id="con'+k+'"></td><td><button type="button" name="condition" id="'+k+'" class="btn btn-success btn_condition">+</button></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td><td><input type="hidden" name="rule[]" value="2" /></td> </tr>');  
      });

      $("#rule3").click(function(){
        i++;
        m++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><select class="form-control" name="name1[]"><option>email</option><option>first_name</option><option>last_name</option></select></td><td><select class="form-control" name="name2[]"><option>is</option><oion>is_not</option><option>starts_with</option><option>ends_with</option><option>contains</option><option>doesnot_starts_with</option><option>doesnot_ends_with</option><option>doesnot_contains</option></select></td><td><input type="text" name="name3[]" class="form-control name_list" /></td><td id="con3'+m+'"></td><td><button type="button" name="condition" id="'+m+'" class="btn btn-success btn_condition3">+</button></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td><td><input type="hidden" name="rule[]"  value="3"/></td></tr>');  
      });

      $(document).on('click', '.btn_condition', function(){  
        var button_id = $(this).attr("id");   
        $('#con'+button_id+'').append('<select class="form-control" name="name5[]"><option>or</option><option>and</option></select>');  
        
      });

      $(document).on('click', '.btn_condition2', function(){  
        var button_id = $(this).attr("id");   
        $('#con2'+button_id+'').append('<select class="form-control" name="name5[]"><option>or</option><option>and</option></select>');  
      });
      
      $(document).on('click', '.btn_condition3', function(){  
        var button_id = $(this).attr("id");   
        $('#con3'+button_id+'').append('<select class="form-control" name="name5[]"><option>or</option><option>and</option></select>');  
      });
      
      $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
      });

      /* if ($('.field_show option:selected').text() !== "Between") {
            $('.field_hide').hide();
        }
        if ($(".field_show").val() == "Between") {
            $('.field_hide').show();
        } */
        

            $("#field_show").change(function () {
            var selected_option = $('#field_show').val();
            if (selected_option == 'Between') {
                $('#field_hide').attr('pk','1').show();
            }
            if (selected_option != 'Between') {
                $("#field_hide").removeAttr('pk').hide();
            }
        })

      /* $("#submit").on('click',function(){
        var formdata = $("#add_name").serialize();
        $.ajax({
          url   :"action.php",
          type  :"POST",
          data  :formdata,
          cache :false,
          success:function(result){
            alert(result);
            $("#add_name")[0].reset();
          }
        });
      }); */

    });
  </script>
@endsection
