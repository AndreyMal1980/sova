function lineDelete(id, line) {
    if (!confirm("Уверены, что хотите удалить линию ("+line+")?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/index.php/admin/settingLines/delete",
        data: "id=" + id,   
       beforeSend: function() {
             // alert(id);
            },
        
        success: function(data){
           // alert(data);
            var obj = $.parseJSON(data);
         
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="8" class="u-delete">линия удалена</td>');
                $("#tr-"+id).hide(3500);
            } else {
                if (obj.message != '') {
                    alert (obj.message);
                } else {
                    alert ('упс..... ошибочка');
                }
            }
        }
    });
    return false;
}
