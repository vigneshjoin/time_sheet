function l(){$(".chat-content").scrollTop($(".chat-content").prop("scrollHeight"))}window.Echo.private("message."+USER.id).listen("Message",i=>{console.log(i);let e=$(".chat-content").attr("data-inbox-user"),s=$(".chat-content").attr("data-inbox-listing");if(e==i.user.id&&s==i.listing_id){let t=`
            <div class="chat-item chat-left" style="">
                <img class="chat-profile" src="${i.user.avatar}">
                <div class="chat-details">
                    <div class="chat-text">${i.message_data}</div>
                </div>
            </div>
            `;$(".chat-content").append(t),l()}$(".profile_card").each(function(){let t=$(this).data("sender-id"),a=$(this).data("listing-id");t==i.user.id&&a==i.listing_id&&$(this).find(".profile_img").addClass("new_message")})});window.Echo.join("online").here(i=>{$.each(i,function(e,s){$(".profile_card").each(function(){$(this).data("sender-id")==s.id&&$(this).find(".user-status").html('<div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>')})})}).joining(i=>{$(`.profile_card[data-sender-id="${i.id}"]`).find(".user-status").html('<div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>')}).leaving(i=>{$(`.profile_card[data-sender-id="${i.id}"]`).find(".user-status").html('<div class=" text-small font-600-bold"><i class="fas fa-circle"></i> Offline</div>')});
