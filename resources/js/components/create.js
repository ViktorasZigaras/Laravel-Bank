
import { drawIndexInit } from './index';
import { displayErrorMessages } from './helpers';

export const drawCreateInit = () => {
    
    axios.post('http://localhost/Laravel-Bank/public/accountsJS/create', {}).then( (response) => {  
        console.log('getting edit info');

        console.log(response.data);

        const data = response.data;

        const contentJSONDOM = document.querySelector('#contentJSON');
        if (contentJSONDOM) {

            contentJSONDOM.innerHTML = `
                <div class="card-header">Edit Account</div>

                <div class="card-body"> 

                    <div class="form-group">
                        <label> Account </label>
                        <input type="text" id="createAccount" name="account" value="${data.newAccount}" class="form-control">
                        <small class="form-text text-muted">Account Name</small>
                    </div>

                    <div class="form-group">
                        <label>Personal Code</label>
                        <input type="text" id="createPersonID" name="personal_code" value="${data.newPersonID}" class="form-control">
                        <small class="form-text text-muted">Person's ID</small>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="createName" name="name" value="${data.newName}" class="form-control">
                        <small class="form-text text-muted">Person's Name</small>
                    </div>

                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" id="createSurname" name="surname" value="${data.newSurname}" class="form-control">
                        <small class="form-text text-muted">Person's Surname</small>
                    </div>

                    <button id="createButton" type="submit" onclick=""> ADD </button>

                </div>
            `;

            //  

            const createButton = document.querySelector('#createButton');
            if (createButton) {
                createButton.addEventListener("click", () => { 
                    console.log('create');
                    // console.log(data.newUuid, data.newValue);
                    axios.post('http://localhost/Laravel-Bank/public/accountsJS/store', 
                    {
                        uuid: data.newUuid,
                        account: document.querySelector('#createAccount').value,
                        personal_code: document.querySelector('#createPersonID').value,
                        name: document.querySelector('#createName').value,
                        surname: document.querySelector('#createSurname').value,
                        value: data.newValue,
                    }).then( (response) => {  
                        console.log(response);
                        drawIndexInit();
                    })
                    .catch( (error) => {
                        console.log(error);
                        console.log(error.response.data.errors);
                        displayErrorMessages(error.response.data.errors);
                    } );
                });
            }
           
        }

    })
    .catch( (error) => {console.log(error);} );

}