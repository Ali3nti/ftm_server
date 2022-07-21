$(document).ready(function ()
  {
    // alert("ready");
    $('#province-dropdown').change(function ()
      {
        $("#cities").empty();
        //var city = $(this).find('option:selected').text();
        var province = $("#province-dropdown").find('option:selected').val();
        $.get("get_province/" + province , function (data, status)
          {
            // console.log(data,jQuery.parseJSON(data));
            $.each(jQuery.parseJSON(data), function (i, item)
              {
                console.log(item);
                $('#cities').append('<option value="' + item.id + '" selected>' + item.name + '</option>');
              }
            )
          }
        );
      }
    );
  }
)