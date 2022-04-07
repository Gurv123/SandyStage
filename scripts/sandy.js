jQuery.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
        validLabels = /^(data|css):/,
        attr = {
            method: matchParams[0].match(validLabels) ?
                matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels, '')
        },
        regexFlags = 'ig',
        regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g, ''), regexFlags);
    return regex.test(jQuery(elem)[attr.method](attr.property));
}

function arty(id, new_id) {
    var childs = $(document).find(".treegrid-parent-" + id); //Liste de l'ensemble des fils 
    for (let c = 0; c < childs.length; c++) { //Chaque fils
        var classList = $(childs[c]).attr('class').split(/\s+/); //Récupération de la liste des classes d'un fils
        //console.log(classList);
        for (var i = 0; i < classList.length; i++) { //Boucle filtre sur la liste pour récupérer uniquement l'id du fils
            if (classList[i].match(/^treegrid-[0-9]/)) {
                var id_child = classList[i].split('treegrid-')[1];
            }
        }
        if (new_id != '') { //On calcule la "réelle" position dans l'arbre du fils
            new_id = new_id + "-" + (c + 1);
        } else {
            new_id = c + 1;
        }

        //console.log("ID actuel : " + id_child);
        //console.log("ID reel : " + new_id);

        $(childs[c]).closest('tr').removeClass('treegrid-' + id_child); //On retire la classe id du fils
        $(childs[c]).closest('tr').addClass('treegrid-' + new_id); //On mets la classe avec le nouvel id calculé

        if ($(childs[c]).hasClass('node')) { //On modifie le texte
            $(childs[c]).find('.treegrid-container').text('Noeud ' + new_id);
            arty(id_child, new_id); //On appelle la fonction par récusivité pour les enfants du noeud
        } else {
            $(childs[c]).find('.treegrid-container').text('Item ' + new_id);
        }
        if (new_id.length > 1) { //On retire la modification de la variable pour le frère
            new_id = new_id.substring(0, new_id.length - 2);
        } else new_id = '';
    }
    init();
}

function init() {
    $(document).ready(function() {
        $('.tree-add').treegrid();
        $('.tree-move').treegrid();
        $('.tree-move').treegrid({
            enableMove: true,
            //Evenement lors du déplacement d'un élément
            onMove: function(item, helper, target, position) {
                return true;
            },
            //Evenement lors du survol d'un élément avec l'élement en déplacement
            onMoveOver: function(item, helper, target, position) {
                if (target.hasClass('treegrid-0')) return false;
                console.log(target + " pos" + position);
                //console.log("Item :" + item.attr('class'));
                //console.log("Target :" + target.attr('class'));

                var classList = target.attr('class').split(/\s+/); //Récupération de la liste des classes de père
                for (var i = 0; i < classList.length; i++) { //Boucle filtre sur la liste pour récupérer uniquement l'id parent de la cible
                    if (classList[i].match(/^treegrid-parent-/)) {
                        var id_pere = classList[i].split('treegrid-parent-')[1];
                        console.log(id_pere);
                    }
                }
                var pere = $(document).find(".treegrid-" + id_pere);
                //console.log("pere", pere);

                if (item.hasClass('item')) {
                    if (target.hasClass('item') && position != 1) {
                        target.treegrid('expand');
                        return true;
                    } else if (pere.hasClass('has-item') && position != 1) {
                        target.treegrid('expand');
                        return true;
                    } else if (!target.hasClass('has-node') && position == 1) {
                        target.treegrid('expand');
                        return true;
                    } else {
                        //console.log("C'est non 1");
                        return false;
                    }
                } else if (item.hasClass('node')) {
                    if (target.hasClass('has-item') && position != 1) {
                        target.treegrid('expand');
                        return true;
                    } else if (!target.hasClass('has-item')) {
                        target.treegrid('expand');
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    //console.log("C'est non 0");
                    return false;
                }
            },
        });
    });
}
$(document).ready(function() {
    init();
});
$(document).on('click', '.tree-add-root', function(e) {
    e.preventDefault();
    var root_node_count = ($('.treegrid-parent-0').length);
    var node_count = ($('tr:regex(class,treegrid-\\d+)').length);
    //console.log('Nombre de noeud sous la racine : ' + root_node_count);
    //console.log('Nombre de noeuds en tout : ' + node_count);
    $('.tree-add').treegrid('add', ['<tr class=\"node treegrid-' + (root_node_count + 1) + ' treegrid-parent-0\">' +
        '<td class="noeud">Noeud ' + (root_node_count + 1) + '</td>' +
        '<td class="intitule" contenteditable="true">Intitule</td>' +
        '<td class="desc" contenteditable="true">Descriptif</td>' +
        '<td><a href="#" class=\"tree-add-node\">Ajouter un noeud enfant</a></td>' +
        '<td><a href="#" class=\"tree-add-item\">Ajouter un item</a></td>' +
        '<td><a href="#" class=\"tree-remove-node\">Supprimer un noeud</a></td>' +
        '</tr>'
    ]);
    arty(0, "");
});
$(document).on('click', '.tree-add-node', function(e) {
    e.preventDefault();
    var pere = $(this.closest('tr'));
    var chemin = $(pere).find('.noeud').find('div').text().split("Noeud ")[1];
    var freres = $(document).find(".treegrid-parent-" + chemin).length;
    var id = chemin + '-' + (freres + 1);
    var profondeur = parseInt($(document).find(".treegrid-" + chemin).treegrid('getDepth') + 1);
    // console.log('Chemin : ' + chemin);
    // console.log('Freres : ' + freres);
    // console.log('ID : ' + id);
    // console.log('Profondeur  : ' + profondeur);
    if (profondeur < 9) {
        //console.log("Profondeur inférieure à 9");
        $(this).closest('tr').treegrid('add', ['<tr class="node treegrid-' + id + '">' +
            '<td class="noeud">Noeud ' + id + '</td>' +
            '<td class="intitule" contenteditable="true">Intitule</td>' +
            '<td class="desc" contenteditable="true">Descriptif</td>' +
            '<td class="add-node"><a href="#" class="tree-add-node">Ajouter un noeud enfant</a></td>' +
            '<td class="add-item"><a href="#" class="tree-add-item">Ajouter un item</a></td>' +
            '<td class="del-node"><a href="#" class="tree-remove-node">Supprimer un noeud</a></td>' +
            '</tr>'
        ]);
        $(this).closest('tr').find(".tree-add-item").addClass('disabled');
        $(this).closest('tr').addClass('has-node');
        $(this).closest('tr').treegrid('expand');
    } else if (profondeur == 9) {
        /*console.log("Profondeur égale à 9");
        console.log($(this).closest('tr'));*/
        $(this).closest('tr').treegrid('add', ['<tr class="node treegrid-' + id + '">' +
            '<td class="noeud">Noeud ' + id + '</td>' +
            '<td class="intitule" contenteditable="true">Intitule</td>' +
            '<td class="desc" contenteditable="true">Descriptif</td>' +
            '<td class="add-node"><a href="#" class="tree-add-node disabled">Ajouter un noeud enfant</a></td>' +
            '<td class="add-item"><a href="#" class="tree-add-item">Ajouter un item</a></td>' +
            '<td class="del-node"><a href="#" class="tree-remove-node">Supprimer un noeud</a></td>' +
            '</tr>'
        ]);
        //console.log($(this).closest('tr'));
        $(this).closest('tr').find(".tree-add-item").addClass('disabled');
        $(this).closest('tr').addClass('has-node');
        $(this).closest('tr').treegrid('expand');

    }
    /*else if (profondeur == 10) {
                   console.log("Profondeur égale à 10");
                   

                   $(this).closest('tr').treegrid('add', ['<tr class="item treegrid-' + id + '">' +
                       '<td class="noeud">Item ' + id + '</td>' +
                       '<td class="intitule" contenteditable="true">Intitule</td>' +
                       '<td class="desc" contenteditable="true">Descriptif</td>' +
                       '<td class="del-item" colspan="3"><a href="#" class="tree-remove-item">Supprimer un item</a></td>' +
                       '</tr>'
                   ]);
                   
               } */
    else {
        //console.log("Profondeur supérieure à 10");
        alert("Profondeur maximum de 10 atteinte");
    }
    arty(0, "");
});
$(document).on('click', '.tree-add-item', function(e) {
    e.preventDefault();
    var pere = $(this.closest('tr'));
    var chemin = $(pere).find('.noeud').find('div').text().split("Noeud ")[1];
    var freres = $(document).find(".treegrid-parent-" + chemin).length;
    var id = chemin + '-' + (freres + 1);
    var profondeur = parseInt($(document).find(".treegrid-" + chemin).treegrid('getDepth') + 1);
    /*console.log('Chemin : ' + chemin);
    console.log('Freres : ' + freres);
    console.log('ID : ' + id);
    console.log('Profondeur  : ' + profondeur);*/
    $(this).closest('tr').treegrid('add', ['<tr class=\"item treegrid-' + id + '">' +
        '<td class="noeud">Item ' + id + '</td>' +
        '<td class="intitule" contenteditable="true">Intitule</td>' +
        '<td class="desc" contenteditable="true">Descriptif</td>' +
        '<td class="del-item" colspan="3" style="text-align: center;"><a href="#" class="tree-remove-item">Supprimer un item</a></td>' +
        '</tr>'
    ]);
    $(this).closest('tr').find(".tree-add-node").addClass('disabled');
    $(this).closest('tr').addClass('has-item');
    $(this).closest('tr').treegrid('expand');
    arty(0, "");
});
$(document).on('click', '.tree-remove-node', function(e) {
    e.preventDefault();
    if (confirm('Supprimer le noeud et ses enfants ?')) {
        var pere = $(this.closest('tr'));
        var classList = pere.attr('class').split(/\s+/);
        for (var i = 0; i < classList.length; i++) {
            if (classList[i].match(/^treegrid-parent-/)) {
                var id_pere = classList[i].split('treegrid-parent-')[1];
                //console.log(id_pere);
            }
        }
        var freres = $(document).find(".treegrid-parent-" + id_pere).length - 1;
        var profondeur = parseInt($(document).find(".treegrid-" + id_pere).treegrid('getDepth') + 1);
        /*console.log($(this).closest('tr'));
        console.log('Chemin : ' + ".treegrid-parent-" + id_pere);
        console.log('Freres : ' + freres);
        console.log('Profondeur : ' + profondeur);*/
        if (parseInt(freres) == 0) {
            $(document).find(".treegrid-" + id_pere).find(".tree-add-item").removeClass('disabled');
            $(document).find(".treegrid-" + id_pere).removeClass('has-node');
        }
        $(this).closest('tr').treegrid('remove');
        arty(0, "");
    }
});
$(document).on('click', '.tree-remove-item', function(e) {
    e.preventDefault();
    if (confirm('Supprimer l\'item ?')) {
        var pere = $(this.closest('tr'));
        var classList = pere.attr('class').split(/\s+/);
        for (var i = 0; i < classList.length; i++) {
            if (classList[i].match(/^treegrid-parent-/)) {
                var id_pere = classList[i].split('treegrid-parent-')[1];
                //console.log(id_pere);
            }
        }
        var freres = $(document).find(".treegrid-parent-" + id_pere).length - 1;
        var profondeur = parseInt($(document).find(".treegrid-" + id_pere).treegrid('getDepth') + 1);
        /*console.log($(this).closest('tr'));
        console.log('Chemin : ' + ".treegrid-parent-" + id_pere);
        console.log('Freres : ' + freres);
        console.log('Profondeur : ' + profondeur);*/
        if (parseInt(freres) == 0 && profondeur < 10) {
            $(document).find(".treegrid-" + id_pere).find(".tree-add-node").removeClass('disabled');
            $(document).find(".treegrid-" + id_pere).removeClass('has-item');
            //console.log('oui');
        }
        $(this).closest('tr').treegrid('remove');
        arty(0, "");
    }
});