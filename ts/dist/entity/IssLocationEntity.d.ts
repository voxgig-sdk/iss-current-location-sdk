import { IssCurrentLocationEntityBase } from '../IssCurrentLocationEntityBase';
import type { IssCurrentLocationSDK } from '../IssCurrentLocationSDK';
import type { Control } from '../types';
import type { IssLocation, IssLocationLoadMatch } from '../IssCurrentLocationTypes';
declare class IssLocationEntity extends IssCurrentLocationEntityBase<IssLocation> {
    constructor(client: IssCurrentLocationSDK, entopts: any);
    make(this: IssLocationEntity): IssLocationEntity;
    load(this: any, reqmatch?: IssLocationLoadMatch, ctrl?: Control): Promise<IssLocationEntity>;
}
export { IssLocationEntity };
