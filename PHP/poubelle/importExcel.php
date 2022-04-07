<html>
    <head>
        <script>
            function getJSON() {
                if(document.querySelector('#excelfile').files.length == 0) {
                    alert('Error : No file selected');
                    return;
                }

                var data = new FormData();
                data.append('file', document.querySelector('#excelfile').files[0]);
                var request = new XMLHttpRequest();
                request.open('post', 'convertExcelToJson.php?action=filedata');
                request.addEventListener('load', function(e) {
                    var obj = JSON.parse(this.responseText);
                    var str1 = JSON.stringify(obj, undefined, 4);
                    output(syntaxHighlight(str1));
                    document.querySelector('pre').style.maxHeight = "280px";
                    document.querySelector('pre').setAttribute("id", "pre");
                    
                    document.getElementById('drag_name').innerText = "Drag your files here or click";
                    document.querySelector('#excelfile').value = '';
                });
                request.send(data);
            }
            
            function checkfile() {
                if(document.querySelector('#excelfile').files.length == 0) {
                        document.getElementById('drag_name').innerText = "Drag your files here";
                    } else {
                        document.getElementById('drag_name').innerText = "1 file has selected";
                    }
            }
            
            function syntaxHighlight(json) {
                json = json.replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>');
                return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                    var cls = 'number';
                    if (/^"/.test(match)) {
                        if (/:$/.test(match)) {
                            cls = 'key';
                        } else {
                            cls = 'string';
                        }
                    } else if (/true|false/.test(match)) {
                        cls = 'boolean';
                    } else if (/null/.test(match)) {
                        cls = 'null';
                    }
                    return '<span class="' + cls + '">' + match + '</span>';
                });
            }
            
            function output(inp) {
                document.getElementById('result').appendChild(document.createElement('pre')).innerHTML = inp;
            }
        </script>
    </head>
    <body>
        <h1>Excel to JSON Converter</h1>
        <div class="form-group">
            <label>Upload File:</label>
            <form>
                <input id="excelfile" type="file" onchange="checkfile()">
                <p id="drag_name">Drag your files here</p>
            </form>
        </div>
        <button class="btn btn-primary" type="submit" onclick="getJSON()">CONVERT</button>
        <div class="form-group">
            <label>Result:</label>
            <div id="result" class="prettyprint" style="min-height: 40vh;max-height:300px;"></div>
        </div>
    </body>
</html>