import axios from "axios"

export const saveOrder = async () => {
    await axios.post('/saveOrder')
}