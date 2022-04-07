$(document).ready(function() {
    document.getElementById('export_audit').addEventListener('click', function(e) {
        e.preventDefault();
        var path = window.location.pathname; //Adresse de la page
        var page = path.split("/").pop().slice(0, -4); //On récupère creation ou edition

        var childs = $(document).find("tr"); //Liste de l'ensemble des noeuds et item 
        //console.log(childs);
        var jsondata = "[";
        for (let c = 0; c < childs.length; c++) { //Chaque éléments
            if ($(childs[c]).hasClass('node') || $(childs[c]).hasClass('item')) {
                var classList = $(childs[c]).attr('class').split(/\s+/); //Récupération de la liste des classes d'un élément
                for (var i = 0; i < classList.length; i++) { //Boucle filtre sur la liste pour récupérer uniquement l'id
                    if (classList[i].match(/^treegrid-[0-9]/)) {
                        var id = classList[i].split('treegrid-')[1];
                    }
                }
                var has = '';
                for (var i = 0; i < classList.length; i++) { //Boucle filtre sur la liste pour récupérer uniquement l'id
                    if (classList[i].match(/^has-/)) {
                        var has = classList[i];
                    }
                }
                if ($(childs[c]).hasClass('node')) {
                    var type = 'node';
					var note = null;
                } else {
                    var type = 'item';
					var note = $(childs[c]).find('.ui-slider-handle').attr("aria-valuenow");
                }
                var intitule = $(childs[c]).find('.intitule').text();
                var desc = $(childs[c]).find('.desc').text();

                var obj = '{"id": "' + id + '", "type": "' + type + '","init": "' + intitule + '","has": "' + has + '","desc": "' + desc + '","note": "' + note + '"}';
                jsondata = jsondata + obj + ',';
            }
        }

        jsondata = jsondata.slice(0, -1);
        jsondata = jsondata + "]";
        const jsonToParse = JSON.parse(jsondata);
        //console.log(jsonToParse);
        var json = JSON.stringify(jsonToParse);
        //console.log(json);

        if (confirm("Confirmez-vous l'export de l'audit ?")) {
            $.ajax({
                method: "GET",
                url: "../export.php?audit=" + page,
                data: {
                    jsondata: json
                },
                dataType: 'json'
            });
			window.location.replace("../export.php?audit=" + page +"&jsondata=" + json);
            //window.location.replace("../redirect.php");
        }
    });
});