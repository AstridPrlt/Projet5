<template>
    <div>
        <form enctype="multipart/form-data" class="d-flex m-3 p-2">
            <!-- <img :src="`./../public/images/avatar.png`" alt="..." class="img-thumbnail rounded-circle" style="width: 175px;"> -->
            <div>
                <img v-show="!showAvatarPreview" :src="`./../public/storage/${authUser.avatar}`" alt="..." class="img-thumbnail rounded-circle" style="width: 175px; height: 175px; min-width: 175px; min-height: 175px;">
                <img v-show="showAvatarPreview" :src="avatarPreview" class="img-thumbnail rounded-circle" style="width: 175px; height: 175px; min-width: 175px; min-height: 175px;">
            </div>
            <div class="w-100 align-self-center ml-3">
                <a v-show="readOnlyAvatar" type="button" style="color: teal;" @click="makeUpdateAvatar">Modifier ma photo</a>
                <div v-show="!readOnlyAvatar" class="custom-file">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="custom-file" aria-describedby="inputGroupFileAddon01" @change="showPreview">
                        <label class="custom-file-label" for="custom-file" data-browse="Parcourir">Choisir une image...</label>
                    </div>
                    <div class="d-flex justify-content-center m-2">
                        <button type="button" class="btn btn-outline-perso mx-2" @click="cancelUpdateAvatar">Annuler</button>
                        <button type="button" class="btn btn-perso mx-2" @click="updateAvatar">Valider</button>
                    </div>
                </div>
            </div>
        </form>

        <form class="border rounded m-3 p-2" style="border-color: lightgray;">
            <h5>Mes informations</h5>
            <div  class="form-group row">
                <label for="staticName" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" v-show="readOnlyInfo" readonly class="form-control-plaintext" id="staticName" v-model="authUser.name">
                <!-- <input type="text" v-show="readOnly" readonly class="form-control-plaintext" id="staticName" :value="`${authUser.name}`"> -->
                <input type="text" v-show="!readOnlyInfo" class="form-control" id="staticName" v-model="authUser.name">
                </div>
            </div>

            <div class="form-group row">
                <label for="staticJob" class="col-sm-2 col-form-label">Spécialité</label>
                <div class="col-sm-10">
                <input type="text" v-show="readOnlyInfo" readonly class="form-control-plaintext" id="staticJob" v-model="authUser.job">
                <input type="text" v-show="!readOnlyInfo" class="form-control" id="staticJob" v-model="authUser.job">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticDesc" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                <textarea type="text" v-show="readOnlyInfo" readonly class="form-control-plaintext" id="staticDesc" v-model="authUser.user_description"></textarea>
                <textarea type="text" v-show="!readOnlyInfo" class="form-control" rows="5" id="staticDesc" v-model="authUser.user_description"></textarea>
                </div>
            </div>

            <button v-show="readOnlyInfo" type="button" class="btn btn-perso w-100 my-1" @click="makeUpdateInfo">Modifier les infos</button>
            <button v-show="!readOnlyInfo" type="button" class="btn btn-perso w-100 my-1" @click="updateProfile">Enregistrer</button>
        </form>

        <form class="border rounded m-3 p-2" style="border-color: lightgray;">
            <h5>Mes identifiants</h5>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="text" v-show="readOnlyIds" readonly class="form-control-plaintext" id="staticEmail" v-model="authUser.email">
                <input type="text" v-show="!readOnlyIds" class="form-control" id="staticEmail" v-model="authUser.email">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword">
                </div>
            </div>

            <button v-show="readOnlyIds" type="button" class="btn btn-perso w-100 my-1" @click="makeUpdateIds">Modifier les identifiants</button>
            <button v-show="!readOnlyIds" type="button" class="btn btn-perso w-100 my-1" @click="updateProfile">Enregistrer</button>
        </form>
    </div>
</template>

<script>
export default {

    data() {
        return {
            authUser: {},

            readOnlyAvatar: true,
            avatarImage: null,
            avatarPreview:null,
            showAvatarPreview: false,

            readOnlyInfo: true,
            readOnlyIds: true,
        }
    },

    methods: {
        makeUpdateAvatar() {
            this.readOnlyAvatar = false;
        },
        cancelUpdateAvatar(){
            this.readOnlyAvatar = true;
            this.avatarPreview = null;
            this.showAvatarPreview = false;
        },
        makeUpdateInfo() {
            this.readOnlyInfo = false;
        },
        makeUpdateIds() {
            this.readOnlyIds = false;
        },

        showPreview(event) {
            // this.avatarImage = event.target.files[0];
            this.authUser.avatar = event.target.files[0];
            let preview  = new FileReader();
            // preview.readAsDataURL(this.avatarImage);
            preview.readAsDataURL(this.authUser.avatar);
            preview.onload = event => {
                this.showAvatarPreview = true;
                this.avatarPreview = event.target.result;
            }
        },

        updateProfile() {
            axios.patch('http://localhost/Projet5/public/myProfile/' + this.authUser.id, {
                name: this.authUser.name,
                email: this.authUser.email,
                job: this.authUser.job,
                user_description: this.authUser.user_description
            })
            .then((response) => {
                console.log(response);
                this.readOnlyInfo = true;
                this.readOnlyIds = true;
                })
            .catch(error => console.log(error))
        },

        updateAvatar() {
            let avatarData = new FormData();
            // avatarData.append('avatar', this.avatarImage);
            avatarData.append('avatar', this.authUser.avatar);
            axios.post('http://localhost/Projet5/public/myProfile/avatar/' + this.authUser.id, avatarData)
            .then((response) => {
                console.log(avatarData, response);
                // this.cancelUpdateAvatar();
                this.readOnlyAvatar = true;
                })
            .catch(error => console.log(error))
        }
    },

    created() {
        axios.get('http://localhost/Projet5/public/myProfile')
        .then(response => this.authUser = response.data)
        .catch(error => console.log(error));
    },

}
</script>
