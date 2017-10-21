function openModal(modalName, btnName)
{
  // Get the modal
  var modal = document.getElementById(modalName);

  // Get the button that opens the modal
  var btn = document.getElementById(btnName);

  // Get the <span> element that closes the modal
  var span = document.getElementById('close' + modalName);

  // When the user clicks the button, open the modal
  btn.onclick = function() {
      modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
        }
      }
}

$("#newHistory").submit(function(event)
  {
    event.preventDefault();
    $.ajax({
      url: url + 'newHistory',
      type: 'POST',
      data:  $(this).serialize()
    })
    .done(function(response)
    {
      window.location.reload();
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
});

$("#newComment").submit(function(event)
{
  event.preventDefault();
  $.ajax({
    url: url + 'newComment',
    type: 'POST',
    data: $(this).serialize(),
  })
  .done(function(response)
  {
    window.location.reload();
    // $('#o').load(url + '/getComments');

  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });

});

function voteHistory(idHistory, vote)
{
  $.ajax({
    url: url + 'voteHistory',
    type: 'POST',
    dataType:'json',
    data: {idHistory : idHistory, vote : vote },
  })
  .done(function(r)
  {
    $("#likes" + idHistory).text(r.likes)
    $("#dislikes" + idHistory).text(r.dislikes)
    console.log(r.dislikes);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });

}

function voteComment(idHistory, idComment, vote)
{
  $.ajax({
    url: url + 'voteComment',
    type: 'POST',
    dataType:'json',
    data: {idHistory: idHistory, idComment: idComment, vote: vote },
  })
  .done(function(r)
  {
    $('#commentLikes' + idComment).text(r.likes)
    $('#commentDislikes' + idComment).text(r.dislikes)
    console.log(r.likes);
    console.log(r.dislikes);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });

}
