
    $(function () {
        var colM = [
            { title: "", width: '1%', type:"detail" },
            { title: "Source", width: '10%', dataIndx: "type",filter: { 
                type: 'textbox',
                listeners : [ 'change' ] 
                        } 
         },
            { title: "Notification", width: '85%',dataIndx: "title",filter: { 
                type: 'textbox', 
                listeners : [ 'change' ]
            } }
		];
        var dataModel = {
            location: "remote",
            sorting: "local",
            dataType: "JSON",
            method: "GET",
            url: "/notification/all",
            getData: function (dataJSON) {
                return { data: dataJSON.data };
            }
        }

        var grid1 = $("#grid_notification").pqGrid({
            //width: '100%',
            height: 'flex',
            collapsible: false,
            pageModel: { type: "remote", rPP: 20, strRpp: "{0}", strDisplay: "{0} to {1} of {2}" },
            selectionModel: { swipe: true },
            scrollModel:{pace: 'fast', autoFit: true,lastColumn:'auto',flexContent:true },
            dataModel: dataModel,
            filterModel: { header: true,type:'remote' }, 
            detailModel: { 
                cache:true, 
                init: function(ui){
                    var rowData=ui.rowData;
                    return $template;    
                } 
            },
            selectionModel: {type: 'null', mode: 'single'},
            colModel: colM,
            wrap: true, hwrap: false,
            //freezeCols: 2,            
            numberCell: { show: false, resizable: true, title: "" },
            title: "",
            resizable: true
        });
    });
