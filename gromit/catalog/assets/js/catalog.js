$(document).ready(function () {
    $("#category-tree").sortable({
        items: ".tree-node",
        handle: ".tree-node",
        update: function (event, ui) {
            let nodeId = ui.item.data("id");
            let targetId = ui.item.prev().data("id") || null;

            $.request('onMoveCategory', {
                data: { node_id: nodeId, target_id: targetId },
                success: function(response) {
                    if (response.success) {
                        console.log("Категория успешно перемещена");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ошибка при перемещении категории:", error);
                }
            });
        }
    });
});
