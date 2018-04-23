
$(function () {
    var grid1 = "";
    var current_selected_time_to = moment().format("YYYY-MM-DD HH:mm:ss");
    var current_selected_time_from = moment().format("YYYY-MM-DD") + " 00:00:00";
    var colM = [
        { title: "", width: '1%', type: "detail" },
        {
            title: "Source", width: '10%', dataIndx: "type", filter: {
                type: 'textbox',
                listeners: ['change']
            }
        },
        {
            title: "Notification", width: '60%', dataIndx: "data", filter: {
                type: 'textbox',
                listeners: ['change']
            }
        },
        {
            title: "Created At", dataIndx: "created_at", hwrap: true, filter: {
                type: '<button id="created_at" name="created_at"\
                 class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"\
                  style="width:100%;white-space: normal;"></button>',
                init: pqDatePicker,
            }
        },
        {
            title: "Read At", dataIndx: "read_at", filter: {
                type: '<button id="read_at" name="read_at"\
                 class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"\
                  style="width:100%;white-space: normal;"></button>',
                init: pqDatePicker
            }
        }
    ];
    var dataModel = {
        location: "remote",
        sorting: "local",
        dataType: "JSON",
        method: "GET",
        url: "/notification/all",
        getData: function (dataJSON) {
            return { data: dataJSON.data, totalRecords: dataJSON.total };
        }
    }
    grid1 = $("#grid_notification").pqGrid({
        height: 'flex',
        collapsible: false,
        pageModel: { type: "remote", rPP: 20, strRpp: "{0}", strDisplay: "{0} to {1} of {2}" },
        selectionModel: { swipe: true },
        scrollModel: { pace: 'fast', autoFit: true, lastColumn: 'auto', flexContent: true },
        dataModel: dataModel,
        filterModel: { header: true, type: 'remote' },
        detailModel: {
            cache: true,
            init: function (ui) {
                var rowData = ui.rowData;
                $template = $("<p class='bg-info' style='padding:3px'>" + (ui.rowData.details) + "</p>");
                return $template;
            }
        },
        selectionModel: { type: 'null', mode: 'single' },
        colModel: colM,
        wrap: true, hwrap: false,
        numberCell: { show: false, resizable: true, title: "" },
        title: "",
        resizable: true,
        load: function (event, ui) {
            for (var i = 0; i < ui.dataModel.data.length; i++) {
                if (ui.dataModel.data[i].read_at == null || ui.dataModel.data[i].read_at == "") {
                    setTimeout((j) => {
                        $("tr[pq-row-indx=" + j + "]").addClass("notification-unread", 2000, 'swing');
                        setTimeout((k) => {
                            $("[pq-row-indx=" + k + "]").removeClass("notification-unread", 500);
                        }, 1000, j);
                    }, 300 + 30 * i, i);
                }
            }
        }
    });
    function pqDatePicker(ui) {
        var $this = $(this);
        function cb(start, end) {
            current_selected_time_to = moment(end).format("YYYY-MM-DD HH:mm:ss");
            current_selected_time_from = moment(start).format("YYYY-MM-DD HH:mm:ss");
            $this.html(moment(start).format("YYYY-MM-DD HH:mm:ss") + " TO " + moment(end).format("YYYY-MM-DD HH:mm:ss"));
            $("#grid_notification").pqGrid("filter", {
                oper: 'add',
                data: [
                    { dataIndx: $this.attr('id'), condition: 'between', value: moment(start).format("YYYY-MM-DD HH:mm:ss"), value2: moment(end).format("YYYY-MM-DD HH:mm:ss") },
                ]
            });
        }
        $this.daterangepicker({
            "showCustomRangeLabel": false,
            "showDropdowns": true,
            "showWeekNumbers": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "dateLimit": {
                "days": 90
            },
            "ranges": {
                "Today": [
                    moment().format("YYYY-MM-DD") + " 00:00:00",
                    moment().format("YYYY-MM-DD HH:mm:ss")
                ],
                "Yesterday": [
                    moment().subtract(1, "days").format("YYYY-MM-DD") + " 00:00:00",
                    moment().subtract(1, "days").format("YYYY-MM-DD HH:mm:ss")
                ],
                "Last 7 Days": [
                    moment().subtract(7, "days").format("YYYY-MM-DD") + " 00:00:00",
                    moment().format("YYYY-MM-DD HH:mm:ss")
                ],
                "Last 30 Days": [
                    moment().subtract(30, "days").format("YYYY-MM-DD") + " 00:00:00",
                    moment().format("YYYY-MM-DD HH:mm:ss")
                ],
                "This Month": [
                    moment().format("YYYY-MM-") + "01 00:00:00",
                    moment().format("YYYY-MM-DD HH:mm:ss")
                ],
                "Last 90 days": [
                    moment().subtract(90, "days").format("YYYY-MM-DD") + " 00:00:00",
                    moment().format("YYYY-MM-DD HH:mm:ss")
                ]
            },
            "locale": {
                "format": "YYYY-MM-DD HH:mm:ss",
                "separator": " TO "
            },
            "linkedCalendars": false,
            "showCustomRangeLabel": false,
            "alwaysShowCalendars": true,
            "parentEl": ".panel .panel-primary",
            "startDate": moment().format("YYYY-MM-DD") + " 00:00:00",
            "endDate": moment().format("YYYY-MM-DD HH:mm:ss"),
            "opens": "left",
            "drops": "down"
        }, cb);
        $this.html(current_selected_time_from + " To " + current_selected_time_to)
    }
});
