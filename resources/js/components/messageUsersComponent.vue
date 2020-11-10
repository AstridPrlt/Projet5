<template>
  <div>
        <div class="modal fade" :id="`messageUsersModal${userToContact.id}`" tabindex="-1" aria-labelledby="messageUsersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageUsersModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {

    props: ['userToContact']

}
</script>
