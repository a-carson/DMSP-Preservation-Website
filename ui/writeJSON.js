// write JSON javascript

    const fs = require('fs');

    var memories =
        [
            {
                name: "Jimmy",
                category: "Childhood",
                memory: "DMSP Preservation",
            },

            {
                name: "Bob",
                category: "Childhood",
                memory: "Went to the shops",
            }
        ]


    // this is where you add the new memory
    memories.push({ name: "Ali", category: "Travel", memory: "new memory" });

    const jsonString = JSON.stringify(memories)

    ////creates file, use this to create file
    //fs.writeFileSync('./memories.json', jsonString)
    //console.log(jsonString)

    fs.writeFile('memories.json', jsonString, err => {
        if (err) {
            console.log('Error writing file', err)
        } else {
            console.log('Successfully wrote file')
        }
    })
