@extends('layouts.admin')
@section('content')


    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title text-uppercase">{{$action." ".$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{$route}}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>
                                    <select name="country[]" class="country form-control" data-row="0" required>
                                        <option value="">Select Country</option>
                                        @foreach($countries as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="state[]" class="state form-control states_row_0" data-row="0" required>
                                        <option value="">Select State</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" step="any" name="tax[]" placeholder="Tax Percentage" class="form-control" required>
                                </td>
                                <td>
                                    <button type="button" id="add" class="btn btn-success"><i
                                            class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success col-md-12">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script !src="">
        $(document).ready(function () {
            var countries_php = '<?php echo $countries ?>';
            var countries = JSON.parse(countries_php, countries_php);

            var countries_select = "";
            for (let j = 0; j < countries.length; j++) {
                countries_select += ` <option value="${countries[j].id}">${countries[j].name}</option>`
            }


            var i = 1;
            $('#add').click(function () {
                $('#dynamic_field').append(`<tr id="row${i}">
                                                <td>
                                                    <select name="country[]" class="country form-control" data-row="${i}" required>
                                                        <option value="">Select Country</option>
                                                        ${countries_select}
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="state[]" class="state form-control states_row_${i}" data-row="${i}" required>
                                                        <option value="">Select State</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" step="any" name="tax[]" placeholder="Tax Percentage" class="form-control" required>
                                                </td>
                                                <td>
                                                    <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </td>
                                            </tr>`
                );
                i++;
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });



            $(document).on('change','.country', function () {
                var country_id = $(this).val();
                var country_row = $(this).data('row');

                if (country_id) {
                    $.ajax({
                        url: "{{url('/getStates')}}/" + country_id,
                        type: "GET",
                        dataType: "json",
                        success: function (res) {

                            $('.state').each(function (index, item) {
                                if($(item).data('row') == country_row){
                                    var item_row = $(item).data('row');
                                    $('.states_row_'+item_row).empty();
                                    $.each(res.states, function (i, states) {
                                        $('.states_row_'+item_row).append('<option value="' + states.id + '">' + states.name + '</option>');
                                    });
                                }
                            });

                        }
                    });
                }
            });
        });
    </script>
@endpush
