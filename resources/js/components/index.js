
import { drawEditInit } from './edit';

export const drawIndexInit = () => {

    axios.post('http://localhost/Laravel-Bank/public/accountsJS', {}).then( (response) => {  
        console.log('getting index info');

        console.log(response.data);

        const data = response.data;

        const contentJSONDOM = document.querySelector('#contentJSON');
        if (contentJSONDOM) {

            let accounts = '';
            let editButton, deleteButton, addButton, removeButton;

            Object.entries(data.accounts).forEach( account => {

                account = account['1'];

                accounts += `
                    <span>
                        ${account.account} 
                        ( ${account.personal_code} ) 
                        ${account.name} 
                        ${account.surname}: 
                        ${account.value} 
                        &euro; 
                        ${account.value * data.rate} 
                        &dollar;
                    </span>
                `;

                if (data.role === 'admin') {
                    accounts += `
                        <div class="flex">

                            <button id="editButton${account.id}" type="submit"> EDIT </button>

                            <button id="addButton${account.id}" type="submit"> ADD </button>

                            <button id="removeButton${account.id}" type="submit"> REMOVE </button>

                            <input id="value${account.id}" type="text" name="value" value="0" class="list-input">

                            <button id="deleteButton${account.id}" type="submit"> DELETE </button>

                        </div>
                    `;
                }

            });

            contentJSONDOM.innerHTML = `
                <div class="card-header"> Account List </div>

                <div class="card-body"> ${accounts} </div>
            `;

            Object.entries(data.accounts).forEach( account => {

                account = account['1'];

                editButton = document.querySelector('#editButton' + account.id);
                if (editButton) {
                    editButton.addEventListener("click", () => { 
                        console.log('edit');
                        drawEditInit(account.id);
                    });
                }

                deleteButton = document.querySelector('#deleteButton' + account.id);
                if (deleteButton) {
                    deleteButton.addEventListener("click", () => { 
                        console.log('delete');
                        axios.post('http://localhost/Laravel-Bank/public/accountsJS/delete/' + account.id, {}).then( (response) => {  
                            console.log(response);
                            drawIndexInit();
                        })
                        .catch( (error) => {
                            console.log(error);
                            // console.log(error.response);
                        });
                    });
                }

                addButton = document.querySelector('#addButton' + account.id);
                if (addButton) {
                    addButton.addEventListener("click", () => { 
                        console.log('add');
                        axios.post('http://localhost/Laravel-Bank/public/accountsJS/add/' + account.id, {
                            value: document.querySelector('#value' + account.id).value,
                        }).then( (response) => {  
                            console.log(response);
                            drawIndexInit();
                        })
                        .catch( (error) => {
                            console.log(error);
                            // console.log(error.response);
                        });
                    });
                }

                removeButton = document.querySelector('#removeButton' + account.id);
                if (removeButton) {
                    removeButton.addEventListener("click", () => { 
                        console.log('remove');
                        axios.post('http://localhost/Laravel-Bank/public/accountsJS/remove/' + account.id, {
                            value: document.querySelector('#value' + account.id).value,
                        }).then( (response) => {  
                            console.log(response);
                            drawIndexInit();
                        })
                        .catch( (error) => {
                            console.log(error);
                            // console.log(error.response);
                        });
                    });
                }

            });
           
        }

    })
    .catch( (error) => {console.log(error);} );

}