<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Document</title>
</head>
<body>
<select class="js-data-example-ajax" style="width: 100%" id="mySelect2" multiple>

</select>

<script>
    $('.js-data-example-ajax').select2({
        ajax: {
            url: '{{route('admin.tags.get-list-tag')}}',
            method:"POST",
            data:function (params){
                return {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search:params.term,
                }
            },
            dataType:'json',
            processResults: function (reponse) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: reponse,
                };
            },
            cache:true,
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        }

    });
    var studentSelect = $('#mySelect2');
    let studentId = 7;
    url = "{{route('admin.tags.get-tags','')}}" + "/" + 7;
    $.ajax({
        type: 'GET',
        url: url,
        dataType:'json',

    }).then(function (data) {
        // create the option and append to Select2
        for(var i = 0; i < data.length; i++)
        {
            var option = new Option(data[i].text, data[i].id, true, true);
            studentSelect.append(option).trigger('change');
        }

        // manually trigger the `select2:select` event
        studentSelect.trigger({
            type: 'select2:select',
            params: {
                data: data,
            }
        });
    });
</script>
</body>
</html>
