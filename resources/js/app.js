import "./bootstrap";

$().ready(() => {
    $('#createpost').click(() => {
        const data = {
            title: "Test Data",
            description: "Test value related description content"
        };

        $.post("/api/post", data).then(res => {
            console.log("Response: ", res);
            let card = "<div class='card-panel darken-1 white-text'>";
            card += `<h4>${res.title}</h4>`;
            card += `<p>${res.description}</p>`;
            card += "</div>";
            $("#response").html(card);
        });
    });

    $('#showpost').click(() => {
        $.get("/api/post").then(res => {
            let cards = [];
            _.forEach(res, (data) => {
                let card = "<div class='col s12'><div class='card-panel indigo darken-1 white-text'>";
                card += `<p>ID: ${data.id}</p>`;
                card += `<h6>Title: ${data.title}</h6>`;
                card += `<p>Desc: ${data.description}</p>`;
                card += `<button class="btn green darken-3 white-text" onclick="disablePost(this,${data.id})">Disable</button>&nbsp;`;
                card += `<button class="btn red darken-3 white-text" onclick="deletePost(this,${data.id})">Delete</button>`;
                card += "</div></div>";
                cards.push(card);
            });
            console.log("Content: ", cards);
            $('#response').html(cards);
        })
    });
});

window.disablePost = (el, cardid) => {
    /*$.put("/api/post/" + cardid, {status: false}).then(res => {
        $(el).remove();
    });*/
    $.ajax({
        type: "PUT",
        url: "/api/post/" + cardid
    }).then(res => {
        console.log(res);
        $(el).parent().remove();
    });
};

window.deletePost = (el, cardid) => {
    /*$.delete("api/post/" + cardid).then(res => {
        $(el).remove();
    });*/
    $.ajax({
        type: "DELETE",
        url: "/api/post/" + cardid
    }).then(res => {
        console.log(res);
        $(el).parent().remove();
    });
};
