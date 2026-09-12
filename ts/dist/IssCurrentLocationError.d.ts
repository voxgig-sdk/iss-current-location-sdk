import { Context } from './Context';
declare class IssCurrentLocationError extends Error {
    isIssCurrentLocationError: boolean;
    sdk: string;
    code: string;
    ctx: Context;
    status: number;
    get notFound(): boolean;
    constructor(code: string, msg: string, ctx: Context);
}
export { IssCurrentLocationError };
