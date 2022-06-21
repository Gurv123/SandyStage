$(document).ready(function() {
    document.getElementById('export_audit').addEventListener('click', function(e) {
        e.preventDefault();
        var path = window.location.pathname; //Adresse de la page
        var page = path.split("/").pop().slice(0, -4); //On récupère creation ou edition
		if(page=="realisation"){
			page="edition";
		}

        var childs = $(document).find("tr"); //Liste de l'ensemble des noeuds et item 
        console.log(childs);

        var jsondata = "[";

        var nbr = 0;

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

                    if ($(childs[c]).hasClass('node') && !($(childs[c]).hasClass('treegrid-0')) && nbr < document.getElementsByClassName('path').length) {
                        if (document.getElementsByClassName('path')[nbr].innerText != '') {
                            var docPath = document.getElementsByClassName('path')[nbr].innerText;
                        } else {
                            var docPath = document.getElementsByClassName('path')[nbr].value;
                        }
                        
                        console.log(document.getElementsByClassName('path'));
                        console.log(docPath);
                        console.log(nbr);

                        if(docPath.match(/^.*[\\\/]/, '')){
                            var doc = docPath.replace(/^.*[\\\/]/, '');
                            console.log(doc);
                        }else{
                            var doc = docPath;
                            console.log(doc);
                        }
                                   
                        nbr += 1;
                    } else{
                        doc = null;
                    }
                } else {
                    var type = 'item';
                    var note = $(childs[c]).find('.ui-slider-handle').attr("aria-valuenow");
                }
				//var intitule = 'intitule';
                var intitule = $(childs[c]).find('.noeud').text();
                var desc = $(childs[c]).find('.desc').text();

                var obj = '{"id": "' + id + '", "type": "' + type + '","init": "' + intitule + '","has": "' + has + '","desc": "' + desc + '","note": "' + note + '", "doc": "' + doc +'"}';
                jsondata = jsondata + obj + ',';
            }
        }

        jsondata = jsondata.slice(0, -1);
        jsondata = jsondata + "]";
        const jsonToParse = JSON.parse(jsondata);
        console.log(jsonToParse);
        var json = JSON.stringify(jsonToParse);
        console.log(json);

        if (confirm("Enregistrer l'audit et les notes ?")) {
            $.ajax({
                method: "GET",
                url: "../export.php?audit=" + page,
                data: {
                    jsondata: json
                },
                dataType: 'json'
            });
            window.location.replace("../export.php?audit=" + page +"&jsondata=" + json);
			
        }
    });
});