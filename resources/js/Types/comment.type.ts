import User from "./user.type";

export default interface Comment {
    comment: string;
    id: number;
    parent_id: null | number;
    post_id: number;
    user: Omit<User, "email">;
    /**
     * This replies is just a extend type interface without replies
     */
    replies: Omit<Comment, "replies">[];
    /**
     * For displaying time according to time lapsed instead of time created
     */
    for_humans: string;
}
