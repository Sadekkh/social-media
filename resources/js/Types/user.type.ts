export default interface User {
    bio: string | null;
    /**
     * This is a link generated from profile_picture
     */
    full_image_path: string;
    id: number;
    name: string;
    profile_picture: string;
    /**
     * This is hidden from backend and will not be included in every response
     */
    email?: string;
}
