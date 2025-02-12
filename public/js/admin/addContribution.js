
// const requestContribution = document.querySelector('.requestContribution')
// const requestOutput = document.querySelector('.requestOutput')



// requestContribution.onclick = async (event) => {
//     const { value: formValues } = await Swal.fire({
//         title: "Add Contribution",
//         html: `
//         <div class="form-group">
//         <label for="exampleFormControlTextarea1 p-2 ">Provide more details and instructions</label>
//         <textarea class="form-control rounded-input" id="exampleFormControlTextarea1" rows="5" name="additional-info"></textarea>
//     </div>
//            <div class="custom-file">
//                     <!-- <label class="custom-file-label" for="customFile">Upload File</label> -->
                    
//                         <br>
//                         <input type="file" class="custom-file-input" id="customFile" name="additional-file">

//                     </div>
//         `,
//         confirmButtonColor: "#0B790B",
//         focusConfirm: false,
//         preConfirm: () => {
//           return [
//             document.getElementById("swal-input1").value,
//             document.getElementById("swal-input2").value
//           ];
//         }
//       });
//       if (formValues) {
//         Swal.fire(JSON.stringify(formValues));
//       }
    
// }

// requestOutput.onclick = async (event) => {
//     Swal.fire({
//         title: "Request Output?",
//         text: "",
//         icon: "question",
//         showCancelButton: true,
//         confirmButtonColor: "#0B790B",
//         cancelButtonColor: "#B20404",
//         confirmButtonText: "Yes, request output"
//       }).then((result) => {
//         if (result.isConfirmed) {
//           Swal.fire({
//             title: "Output Requested",
//             text: "You have requested output.",
//             icon: "success",
//         confirmButtonColor: "#0B790B"           
//           });
//         }
//       });
   
    
// }

