function programmDelete(id, name) {
    if (!confirm("Уверены, что хотите удалить программу ("+name+")?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/index.php/admin/programms/delete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="8" class="u-delete">программа удалена</td>');
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
