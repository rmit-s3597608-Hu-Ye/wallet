function setDeleteModalFileId(fileId) {
    $('#deleteFileModal input').attr('value', fileId);
}

function setRenameModalData(fileId, nameWithoutExt) {
    $('#renameFileModal input[name="id"]').attr('value', fileId);
    $('#renameFileModal input[name="name"]').attr('value', nameWithoutExt);
}

$(document).ready(function () {
    $('.editInfo').on('click', function () {
        let editNode = $(this);
        let parent = editNode.parent();

        let inputNode = parent.find('input');
        let isDisabled = inputNode.prop('disabled');

        let name = inputNode.attr('name');
        let type = '';

        if (isDisabled) {
            inputNode.removeClass('border-0');
            inputNode.prop('disabled', false);
            editNode.text('Done');
        }
        else {
            if(name === 'firstname' || name === 'lastname'){
                type = 'user';
            }else{
                type = 'personal_profile';
            }

            $.ajax({
                type: 'POST',
                url:"ajax_save_personal.php",
                data: {'name':name,'value':inputNode.val(),'type':type},
                dataType: "json",
                success: function(data){
                    alert(data);
                },
            });

            inputNode.addClass('border-0');
            inputNode.prop('disabled', true);
            editNode.text('Edit');
        }
    });

    $('.lastOpened').text(function (i, utcText) {
        if (!utcText) return utcText;
        return moment.utc(utcText).local().format('DD/MM/YYYY HH:mm:ss');
    });
});
