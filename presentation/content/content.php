<div id="content"></div>
<div id="content_gradient"><img src="/content/content_gradient.png"></div>

<ul id="activities">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

<style>
body {
    background: #000000;
    overflow: hidden;
}

#content {
    font-size: 100px;
    color: white;
    max-width: 1100px;
    margin-left: 200px;
    margin-top: 50px;
}
</style>
    <script src="/js/jquery.newsTicker.min.js"></script>
    <script src="/js/jquery.textfill.min.js"></script>
    <script src="/content/content.js"></script>
<script>

var allElements = [];
var contentElement = 1;

function updateContent() {
    var elem = getCurrentElem(allElements);
    if (elem != contentElement && elem.video_only == 0) {
        contentElement = elem;
        lampOff("");
        show_activity(elem.light, elem.action, elem.data, elem.data_pic, "140407_12.wav");
        lampOn(elem.light_id);
    }
}

function displayData() {
    $.getJSON(DATA_JSON, function(data) {
        allElements = data.elements;
        setFullStoryTime(data.fullStoryTime);
        window.setTimeout(function() {
            setInterval(updateContent, timerContent);
        }, STARTUP_TIME);
    });
}

function lampOff(id) {
    sendLampCommand("O=" + id);
}

function lampOn(id) {
    sendLampCommand("I=" + id);
}

function sendLampCommand(data) {
    $.ajax({
      type: "POST",
      url: "http://192.168.111.145:8000",
      data: data
    });
}


displayData();
</script>
