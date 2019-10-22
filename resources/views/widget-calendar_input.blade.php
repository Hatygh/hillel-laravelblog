<!-- ##### Single Widget Area ##### -->
<div class="single-widget-area">
    <!-- Title -->
    <div class="widget-title">
        <h6>Post Calendar</h6>
    </div>

    <div id="datepicker" data-date="21/10/2019"></div>
    <input type="hidden" id="my_hidden_input">

{{--    <div class='container' style='margin-top: 100px;'>--}}
{{--        <input type='text' class="form-control" id='datepicker' style='width: 300px;' > <br>--}}
{{--        <input type='text' class="form-control" data-provide="datepicker" style='width: 300px;' >--}}
{{--    </div>--}}

    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datepicker').datepicker()
            {
                todayHighlight: true
            };
            $('#datepicker').on('changeDate', function() {
                $('#my_hidden_input').val(
                    $('#datepicker').datepicker('getFormattedDate')
                );
            });
        });
    </script>

</div>

