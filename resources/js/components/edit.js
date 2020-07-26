
import { drawIndexInit } from './index';

export const drawEditInit = (id) => {
    
    axios.get('http://localhost/Laravel-Bank/public/accountsJS/edit/' + id).then( (response) => {  
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
                        <input type="text" name="account" value="${data.account}" class="form-control" readonly>
                        <small class="form-text text-muted">Account Name</small>
                    </div>

                    <div class="form-group">
                        <label>Personal Code</label>
                        <input type="text" name="personal_code" value="${data.personal_code}" class="form-control" readonly>
                        <small class="form-text text-muted">Person's ID</small>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="editName" name="name" value="${data.name}" class="form-control">
                        <small class="form-text text-muted">Person's Name</small>
                    </div>

                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" id="editSurname" name="surname" value="${data.surname}" class="form-control">
                        <small class="form-text text-muted">Person's Surname</small>
                    </div>

                    <button id="editButton" type="submit" onclick="">EDIT</button>

                </div>
            `;

            const editButton = document.querySelector('#editButton');
            if (editButton) {
                editButton.addEventListener("click", () => { 
                    console.log('update');
                    console.log(document.querySelector('#editName').value);
                    console.log(document.querySelector('#editSurname').value);
                    axios.post('http://localhost/Laravel-Bank/public/accountsJS/update/' + data.id, 
                    {
                        name: document.querySelector('#editName').value,
                        surname: document.querySelector('#editSurname').value,
                    }).then( (response) => {  
                        console.log(response);
                        drawIndexInit();
                    })
                    .catch( (error) => {
                        console.log(error);
                        console.log(error.response);
                        console.log(error.response.data);
                    } );
                });
            }
           
        }

    })
    .catch( (error) => {console.log(error);} );

}