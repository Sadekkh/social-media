export default interface Post {
    id: number;
    description: string | null;
    user_id: number;
    original_post_id: number | null;
    all_comments_count: number;
    total_likes_count: number;
    user_liked_count: number;
    /**
     * For displaying time according to time lapsed instead of time created
     */
    for_humans: string;
    /**
     * User's permissions of a post
     */
    can: {
        is_post_owner: boolean;
    };
    post_photos: PostPhoto[];
    owner: Owner;
    original_post?: Omit<Post, "original_post">;
}

export interface PostPhoto {
    photo_src: string;
}

export interface Owner {
    full_image_path: string;
    id: number;
    name: string;
    profile_picture: string;
}
