<template>
    <form>
        <div class="form-group row">
            <label for="staticName" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" :value="`${authUser.name}`">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" :value="`${authUser.email}`">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticJob" class="col-sm-2 col-form-label">Spécialité</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" :value="`${authUser.job}`">
            </div>
        </div>
    </form>

</template>

<script>
export default {

    data() {
        return {
            authUser: {}
        }
    },

    created() {
        axios.get('http://localhost/Projet5/public/myProfile')
        .then(response => this.authUser = response.data)
        .catch(error => console.log(error));
    },

}
</script>
