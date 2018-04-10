
    $(function () {
        var colM = [
            { title: "Order ID", width: 100, dataIndx: "OrderID" },
            { title: "Customer Name", width: 130, dataIndx: "CustomerName" },
            { title: "Product Name", width: 190, dataIndx: "ProductName" },
            { title: "Unit Price", width: 100, dataIndx: "UnitPrice", align: "right" },
            { title: "Quantity", width: 100, dataIndx: "Quantity", align: "right" },
		    { title: "Order Date", width: 100, dataIndx: "OrderDate" },
		    { title: "Required Date", width: 100, dataIndx: "RequiredDate" },
		    { title: "Shipped Date", width: 100, dataIndx: "ShippedDate" },
            { title: "ShipCountry", width: 100, dataIndx: "ShipCountry" },
            { title: "Freight", width: 100, align: "right", dataIndx: "Freight" },
            { title: "Shipping Name", width: 120, dataIndx: "ShipName" },
            { title: "Shipping Address", width: 180, dataIndx: "ShipAddress" },
            { title: "Shipping City", width: 100, dataIndx: "ShipCity" },
            { title: "Shipping Region", width: 110, dataIndx: "ShipRegion" },
            { title: "Shipping Postal Code", width: 130, dataIndx: "ShipPostalCode" }
		];
        var dataModel = {
            location: "remote",
            sorting: "local",
            dataType: "JSON",
            method: "GET",
            url: "/pro/invoice/get",
            //url: "/invoice.php", //for PHP
            getData: function (dataJSON) {
                return { data: dataJSON.data };
            }
        }

        var grid1 = $("#grid_paging").pqGrid({
            width: 900,
            height: 400,
            collapsible: false,
            pageModel: { type: "local", rPP: 20, strRpp: "{0}", strDisplay: "{0} to {1} of {2}" },
            selectionModel: { swipe: true },
            dataModel: dataModel,
            colModel: colM,
            wrap: false, hwrap: false,
            //freezeCols: 2,            
            numberCell: { show: false, resizable: true, title: "#" },
            title: "Shipping Orders",
            resizable: true
        });
    });
